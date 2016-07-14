# Avro Generator

An application that can be used to connect on a SQL Server database and export all columns to a specific Avro file `tableName.avsc`.

## How to install

This application was written in PHP, so to run this you will need the PHP with the dlls of SQL Server. To do this, you can follow the baby steps below:

Considering that you are working on Windows Seven, firstly you must [download the PHP](http://windows.php.net/downloads/releases/archives/) interpreter, unzip in a directory of your system and put it in your environment variable `PATH`.

Now [download the SQL Server dll](https://www.microsoft.com/en-us/download/details.aspx?id=20098), note that you must download the correct file to your PHP distribution, this requirements are available on System Requirements in the page below.

Version support for PHP is as follows:

- Version 4.0 supports PHP 7.0+
- Version 3.2 supports PHP 5.6, 5.5, and 5.4
- Version 3.1 supports PHP 5.5 and 5.4
- Version 3.0 supports PHP 5.4.

Next, you need to run the setup.exe (downloaded from Microsoft) and put the files on `unzip-php-directory/ext`.

After that, in the `unzip-php-directory` rename the file `php.ini-development` to `php.ini` and open it on your prefered file editor and put on the end of this file:

```plain
extension="DriveLetter:\unzip-php-directory\ext\php_pdo_sqlsrv_54_ts.dll"
extension="DriveLetter:\unzip-php-directory\ext\php_sqlsrv_54_ts.dll"
```

Note that the `php_pdo_sqlsrv_54_ts` and `php_sqlsrv_54_ts` must be replaced respectively to your PHP version.

Right, at this moment you must be able to run `php -v` on your terminal to verify if the php are working. If not, repeat the steps above.

You must [download the Composer](https://getcomposer.org/Composer-Setup.exe) now, it is a dependency manager for PHP.

After, open your terminal and type `composer install` inside of your this project root to download dependencies.

Now you must set setup your environment variables, so rename the `.env.example` to `.env` and set the connection string to connect on SQL Server database, if you use your windows credentials to connect, you need replace the values of `SERVER_NAME\INSTANCE_NAME` to your real server name and instance name respectively.

Great job guy, that is all. Now, this application are installed.

## Running

In the root of this directory, open your terminal and type:

```shell
php app.php cekurte:avro:generator
```

An assistant will asks you the following questions:

- The database name that you want connect into;
- The directory that will be used to export *.avsc files.

Thanks a lot!

**If you liked of this library, give me a *star =)*.**

Contributing
------------

1. Give me a star **=)**
1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Make your changes
4. Commit your changes (`git commit -am 'Added some feature'`)
5. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request
