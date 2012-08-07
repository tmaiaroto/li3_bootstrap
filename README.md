Lithium Bootstrap
=======

This project will help you quickly get started building Lithium applications.
It is, in a sense, an extremely bare-bones CMS. Each new piece of functionality
is added with a library that is designed to work  with this application.

This application was inspired by and uses Twitter Bootstrap.
It makes for a very good way to play with Lithium, but is also strong
enough to be the foundation of many projects.

### What it Comes With

First off, an administrative UI using Twitter Bootstrap that sets up a clean
and consistent convention for your application.

Then, some of my favorite JavaScript libraries and some helpers. Also, a menu 
system that allows you to define menus within your code using Lithium's filters.
Also, a base model that contains a few properties that help extend some extra
features to your models and controllers. Then some other goodies that are 
designed to, not get in your way but, help you build your application faster.
It also comes with submodules for some basic libraries that are value for 
any application (flash messages, pagination, and so on).

### How it Works

Basically, you will want to clone this repository and then create a new branch
to work off of. This will keep your edits away from the base files in case there
are any updates. You can then, optionally, retrieve any updates in the future.

What kinda updates? Any potential bug fixes, rare updates to things like Twitter
Bootstrap CSS and JavaScript, and various other things including helpers and
utility classes. There actually may end up being quite a few helpers and
other classes in the future, but they are all optional of course. They will
be named so that there is no conflict with other classes.

However, this is a very basic start. The additional features come by way of
extra libraries. Again, you may want to branch these libraries if you are going
to make alterations. However, libraries designed to work with Lithium Bootstrap
also allow you to override view templates by putting some in this application.
For example, /views/_gallery/items/index.html.php would be used for a "gallery"
library's index action for an items controller instead of the view template the
library came with.

This allows you to use 3rd party libraries, but customize the design.
There may be many cases where you simply wish to use these 3rd party libraries
as is, but just have some changes for the design.

Keep in mind that some 3rd party libraries may depend on other libraries.
Composer is used to handle these dependencies where possible.

Also, libraries designed for use with Lithium Bootstrap may have additional
configuration options that allow for some flexibility without the need to
touch any code within those libraries. These configuration options are easily
passed to the library when it is added with Libraries::add().

### 3rd Party Libraries

To make adding libraries built for Lithium Bootstrap easier, there is a console
command tool. This works much like a Linux package manager. This command class
comes with Lithium Bootstrap.

You can search for libraries:
```li3 bootstrap search "swift mailer"```

You can install libraries (and dependencies):
```li3 bootstrap install li3b_users```

Provided the user has access to git. Otherwise, when trying to clone the
repos or add them as submodules, there'll be some problems.

### Setup Instructions

This is going to be a little lengthy, but for those of you who are familiar 
with Lithium, you basically just want to get all the code here and setup your 
local dev environment as normal. The lithium framework has already been added 
as a submodule for this application.

Then you can add via submodule any additional libraries you want to use.

Just a note: Most libraries built for this application primarily uses MongoDB, 
though it is not required. There is nothing in this base application that 
requires a database at all.

So, the long version...
You will need to clone this repo and then run a ```git submodule init``` and 
```git submodule update``` command. It's also important to note that some of 
these libraries have submodules themselves. You can try running something like 
```git submodule update --init --recursive``` to get all submodules within the 
submodules.

It should be a snap to get all the code...And once you have all the code, you'll 
need to set this up on your web server. I personally prefer PHP-FPM and Nginx, 
however you can use Apache and normal PHP, but note you will need at least PHP 
version 5.3 or higher. If you're already familiar with Lithium, then the setup 
should be basically the same in terms of requirements.

If you compare this repo's file structure for the Lithium's "framework" repo 
you'll notice that there is no "app" directory. This is intentional and you 
don't actually need an "app" (or whatever name you like) directory. Namespace 
yes. Directory no. The ```config/bootstrap/libraries.php``` file has been 
updated to reflect this when it comes to the constants and include paths. 
This is a more compact setup for Lithium that puts essentially all libraries 
under the "libraries" directory.

Speaking of libraries...You may want to think about putting all of your code
into libraries as well for organizational reasons. Who knows, you may even find
yourself contributing something back, easily, if you do this.

So the server setup? You'll want to configure your server's conf, virtual host, 
etc. to use ```/path/to/li3bootstrap/webroot``` and you should be all set. 
The index.php file there is used. 

That's it! You're done. If you go to whatever your sub/domain is in your browser 
you should see the sandbox's main screen. From there, you should have all the 
instruction you need to continue.

A final note: If you look at the routes.php file, you'll notice that the
```development``` environment is enabled for specific domains. You will likely
want to adjust this unless you name your domain (edit to your hosts file) the
same way I do on your development machine. Or, you could always run in the
```production``` environment all the time if you really wanted. It may come
in handy when you deploy to a server and have two copies of the code (different
branches) with a subdomain for development.