<?php

namespace App\Http\Controllers;

use App\OrganizationInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationInfoController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_user_perm');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org_info = OrganizationInfo::get()->first();

        return view('app_setup.index', compact('org_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string|max:11',
        ]);

        $org_info = OrganizationInfo::findOrFail($id);
        $org_info->name = $request->name;
        $org_info->save();

        return redirect()->back()->with('success', 'Organization Info Updated Successfully !!');
    }

    /**
     * export database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportDb()
    {

        $db = DB::connection()->getPdo();

        set_time_limit(5000);

        $sql = "";

        $tables=$db->query("SELECT name FROM sqlite_master WHERE type ='table' AND name NOT LIKE 'sqlite_%';");

        while ($table = $tables->fetch(\PDO::FETCH_NUM)) {
            $query = $db->query("SELECT sql FROM sqlite_master WHERE name = '{$table[0]}'");
            // dd($sql->fetch());
            $sql .= $query->fetch()[0].";\n\n";
            $rows = $db->query("SELECT * FROM '{$table[0]}' ");
            $row1 = $db->query("SELECT * FROM '{$table[0]}' ");;

            if( $row1->fetch() )
            {

                $sql .= "INSERT INTO {$table[0]} (";
                $columns = $db->query("PRAGMA table_info({$table[0]})");
                $fieldnames = array();

                while ($column = $columns->fetch(\PDO::FETCH_ASSOC)) {
                    $fieldnames[] = $column["name"];
                }

                $sql .= implode(",", $fieldnames).") VALUES";

                while ( $row = $rows->fetch(\PDO::FETCH_ASSOC)) {
                    foreach ($row as $k => $v ) {
                        $row[$k] = $db->quote($v);
                    }

                    $sql.="\n(".implode(",",$row)."),";
                }

                $sql = rtrim($sql, ",").";\n\n";
            }

            
        }
            
        $backup_name = "database_backup_file_(".date('H-i-s')."_".date('d-m-Y').").sql";

        ob_get_clean(); 
        header('Content-Type: application/octet-stream');  
        header("Content-Transfer-Encoding: Binary");  
        header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($sql, '8bit'): strlen($sql)) );    
        header("Content-disposition: attachment; filename=\"".$backup_name."\""); 

        echo $sql; 
        exit;

        //return redirect()->back()->with('success', '!!');
    }

    /**
     * import database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function importDb(Request $request)
    {   

        // get pdo instance
        $pdo = DB::connection()->getPdo();

        set_time_limit(3000);

        // get sql file from request object
        $sql_file_OR_content = $request->file('sql');

        $SQL_CONTENT = (strlen($sql_file_OR_content) > 300 ?  $sql_file_OR_content : file_get_contents($sql_file_OR_content)  ); 

        // get only sql statement
        $allLines = explode("\n", $SQL_CONTENT);
        // turn off foreign keys check
        $mysql_command = $pdo->exec('PRAGMA foreign_keys = 0');           

        // get strings after create table statement
        preg_match_all("/\nCREATE TABLE(.*)/i", "\n". $SQL_CONTENT, $target_tables); 

        foreach ( $target_tables[1] as $table )
        {
            // trim out only table name
            $table = explode(" ", $table)[1];

            // drop table if it Already exist
            $pdo->query('DROP TABLE IF EXISTS '.$table.';');
        }         

        $mysql_command = $pdo->exec('PRAGMA foreign_keys = 1'); 

        //$pdo->query("SET NAMES 'utf8'");  

        $templine = ''; // Temporary variable, used to store current query
        foreach ($allLines as $line)
        { // Loop through each line
            if ( substr($line, 0, 2) != '--' && $line != '' )
            {
                $templine .= $line; // (if it is not a comment..) Add this line to the current segment
                if (substr(trim($line), -1, 1) == ';') 
                {// If it has a semicolon at the end, it's the end of the query
                    // remove all quote
                    $templine = str_replace('"', " ", $templine);

                    if( !$pdo->query($templine) )
                    { 
                        return redirect()->back()->with('error', 'Error performing query \'<strong>' . $templine . '\': ' . $pdo->errorInfo() . '<br /><br />'); 
                    }  

                    $templine = ''; 
                        // set variable to empty, to start picking up the lines after ";"
                }
            }
        }
    
        return redirect()->back()->with('success', 'database has just been import!! if you are still experiencing any error during Db importation Try to check your Export File for correct syntax !!');
    }

    

}
