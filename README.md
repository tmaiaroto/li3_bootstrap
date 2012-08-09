Lithium Bootstrap
=======

This project will help you quickly get started building Lithium applications.
It is, in a sense, an extremely bare-bones CMS. Each new piece of functionality
is added with a library that is designed to work  with this application.

This application was inspired by and uses Twitter Bootstrap.
It makes for a very good way to play with Lithium, but is also strong
enough to be the foundation of many projects.

Just want to get started? To install, create a virtual host (or whatever you do)
and in the empty site webroot, execute the following command:
```bash <(curl -s https://raw.github.com/tmaiaroto/li3_bootstrap/master/_build/bootstrap.sh)```

### What it Comes With

First off, an administrative UI using Twitter Bootstrap that sets up a clean
and consistent convention for your application.

Then, some of my favorite JavaScript libraries and some helpers. Also, a menu
system that allows you to define menus within your code using Lithium's filters
Also, a base model that contains a few properties that help extend some extra
features to your models and controllers. Then some other goodies that are
designed to, not get in your way but, help you build your application faster.

### How it Works

Basically, you will want to clone this repository and then create a new branch
to work off of. This will keep your edits away from the base files in case there
are any updates. You can then, optionally, retrieve any updates in the future.

There aren't really expected to be any updates to this repository, instead,
you'll see updates to the li3b_core library...But you never know.

After you clone this, you'll want to run the setup script here: _build/setup.sh
This will retrieve the submodules (lithium core, li3b_core, etc.) and symlink
a few things for you as well as set permissions on the resources directory.

Then you're ready to rock!

### 3rd Party Libraries

To make adding libraries built for Lithium Bootstrap easier, there is a console
command tool. This works much like a Linux package manager. This command class
comes with Lithium Bootstrap via the li3b_core library.

You can search for libraries:
```li3 bootstrap search "swift mailer"```

You can install libraries (and dependencies):
```li3 bootstrap install li3b_users```

This will also install dependencies and such. This tool will become
more robust in the future.

### Setup Instructions

You may wish to familiarize yourself with Lithium, its requirements,
and how it's generally configured if you haven't already.

Note: Many plugins for Lithium Bootstrap use MongoDB. Though Lithium Bootstrap
itself does not rely upon any database, you may wish to have MongoDB setup
and running on your server or local environment. Especially while this is
a young project, since I kinda cut MySQL out of my life...You'll have a hard
time finding many plugins/libraries using a database other than MongoDB since
there won't be many other contributors.

I'd strongly suggest running the setup script after cloning this repository.
If you run the bootstrap.sh from remote, then it will automatically run
the setup script for you. If you did run that (command above), congratulations,
you set up Lithium Bootstrap the easy way. If the site loads, you're set.
If not, read over these instructions to see what's going on and what you
may need to double check with regard to configuration.

The hard way (it's not that hard)...

You will need to clone this repo and then run:
```git submodule update --init --recursive```
This will setup all the code you need...But you still have to ensure
777 permissions are set on the resources directory and you need to symlink
the a `_core` directory under the `webroot` directory that links to the
`li3b_core/webroot` directory. So the application can use Lithium Bootstrap
core assets.

It should be a snap to get all the code...And once you have all the code, you'll
need to set this up on your web server. I personally prefer PHP-FPM and Nginx,
however you can use Apache and normal PHP, but note you will need at least PHP
version 5.3 or higher. If you're already familiar with Lithium, then the setup
should be basically the same in terms of requirements.

If you compare this repo's file structure for the Lithium's "framework" repo
you'll notice that there is no "app" directory. This is intentional and you
don't actually need an "app" (or whatever name you like) directory. Namespace
yes. Directory no. The ```config/bootstrap/libraries.php``` file is where you
will specify the namespace for your main application. You should change it from
`app` to be something else. You don't need to, but it's a good idea.

Speaking of libraries...You may want to think about putting all of your code
into libraries as well for organizational reasons. Who knows, you may even find
yourself contributing something back, easily, if you do this.

So the server setup? You'll want to configure your server's conf, virtual host,
etc. to use ```/path/to/li3_bootstrap/webroot``` and you should be all set. 
The index.php file there is used.

Note: You do not need to call your application `li3_bootstrap` you can have
a path like `/var/www/sites/my-awesome-app/webroot` for example.

That's it! You're done. If you go to whatever your sub/domain is in your browser
you should see Lithium Bootstrap's main screen. From there, you should have all
the instruction you need to continue.

A final note: If you look at the routes.php file under the `li3b_core` library,
you'll notice that the ```development``` environment is enabled for specific 
domains. You will likely want to adjust this unless you name your domain
(edit to your hosts file) the same way I do on your development machine.
Or, you could always run in the ```production``` environment all the time 
if you really wanted. It may come in handy when you deploy to a server and
have two copies of the code (different branches) with a subdomain for 
development though and that's why the Evnironment is being set different ways.