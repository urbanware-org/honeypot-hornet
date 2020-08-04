# ***honeypot-hornet***

**Table of contents**
*   [Definition](#definition)
*   [Details](#details)
*   [Usage](#usage)
*   [Contact](#contact)

----

## Definition

An enhanced version of [honeypot-wasp](https://github.com/urbanware-org/honeypot-wasp) with a fake username and password prompt.

[Top](#honeypot-hornet)

## Details

Many websites provide administrative access to a management interface for the webmaster, mostly via a sub-directory called `/admin` and also `/login`.

In case your website does not have such a directory (or with a different name), you can create a fake one and use this honeypot to see the access attempts.

[Top](#honeypot-hornet)

## Usage

### Installation

Installing the honeypot is simple.

1.  Edit `honeypot-hornet.php` and change the name of the log file to something less guessable than `logfile.txt`.

    ```php
    $file = 'logfile.txt';
    ```

1.  Create an empty text file with that name.
1.  Rename `honeypot-hornet.php` to `index.php` or `index.html`.
1.  Create the desired directory where you want to install the honeypot on your web server, e.g. `/admin`.
1.  Upload the renamed file as well as the empty text file into that directory.

### Function test

<img src="https://raw.githubusercontent.com/urbanware-org/honeypot-hornet/master/login.png" alt="Fake login prompt" align="right"/>Use your web browser and navigate to the directory on your website which contains the honeypot file. It will show a login prompt asking for the username and password.

The login data can also be given via URL, for example:

```
https://www.foo.bar/admin?username=admin&password=asdf1234
```

*   If a username other than `admin` is given it will return that the user does not exist.
*   If you try logging in as `admin` it will always return that the password for `admin` is invalid.
*   If no username and password is given it will simply ask to log in.

The allegedly failed attempts return the code **401** (**Unauthorized**).

After that the attempted login has been logged into the given log file. For example:

```
[2018-04-28 - 09:42:10] Attempt to log in at 'https://www.foo.bar/admin'
[2018-04-28 - 09:42:10] Login method: 'POST'
[2018-04-28 - 09:42:10] Username: 'admin'
[2018-04-28 - 09:42:10] Password: 'asdf1234'
[2018-04-28 - 09:42:10] IP address: 192.168.1.2
[2018-04-28 - 09:42:10] User agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.108 Safari/537.36
```

[Top](#honeypot-hornet)

## Contact

Any suggestions, questions, bugs to report or feedback to give?

You can contact me by sending an email to [dev@urbanware.org](mailto:dev@urbanware.org) or by opening a *GitHub* issue (which I would prefer if you have a *GitHub* account).

[Top](#honeypot-hornet)
