# Gate Pass Ticket Issuing/Generating App with Laravel

[![Build Status](https://travis-ci.org/guillaumebriday/laravel-blog.svg?branch=master)](https://github.com/vwedesam/gate-pass-ticket-issuing-system.git)


## Installation

Development environment requirements :
- [php](https://www.php.net/)
- [msql]()

Setting up your development environment on your local machine :
```bash
$ git clone https://github.com/vwedesam/gate-pass-ticket-issuing-system.git
$ cd gate-pass-ticket-issuing-system.git
$ cp .env.example .env
```

Start Laravel dev Server:
```bash
$ php artisan serve
```

Now you can access the application via [http://localhost:8000](http://localhost:8000).


## Before starting
You need to run the migrations with the seeds :
```bash
$ artisan migrate --seed
```

This will create a new user that you can use to sign in :
```yml
Username: Admin@123
password: secret
```

## Some screenshots

 ![dashboard](https://github.com/vwedesam/gate-pass-ticket-issuing-system/blob/master/public/assets/screenshot/Screenshot_2020-10-12%20SamVwede%20Ticketing%20System(7).png)
 
![ticket](https://github.com/vwedesam/gate-pass-ticket-issuing-system/blob/master/public/assets/screenshot/p-and-t.jpeg)

![Ticket Report](https://github.com/vwedesam/gate-pass-ticket-issuing-system/blob/master/public/assets/screenshot/Screenshot_2020-10-12%20SamVwede%20Ticketing%20System(8).png)

![Role Management](https://github.com/vwedesam/gate-pass-ticket-issuing-system/blob/master/public/assets/screenshot/Screenshot_2020-10-12%20SamVwede%20Ticketing%20System.png)

![Assign Permission to Role](https://github.com/vwedesam/gate-pass-ticket-issuing-system/blob/master/public/assets/screenshot/Screenshot_2020-10-12%20SamVwede%20Ticketing%20System(1).png)

![Add Vip Ticket](https://github.com/vwedesam/gate-pass-ticket-issuing-system/blob/master/public/assets/screenshot/Screenshot_2020-10-12%20SamVwede%20Ticketing%20System(2).png)

![Add Vip Group Ticket](https://github.com/vwedesam/gate-pass-ticket-issuing-system/blob/master/public/assets/screenshot/Screenshot_2020-10-12%20SamVwede%20Ticketing%20System(1).png)

## License

This project is released under the [MIT](http://opensource.org/licenses/MIT) license.
