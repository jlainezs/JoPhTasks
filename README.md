# JoPh Tasks #

This is a set of phing tasks which helps me to develop Joomla! extensions.

## Tasks ##

The tasks defined allows you to copy:

* Components
* Modules
* Plugins
* Templates

from your coding directory to the local Joomla installation you are using for development.

## How to use it ##

Examine the ```build.xml``` file on the root to get an idea of how to use those tasks. Specially take a
look to the ```<includepath>``` and ```<taskdef>``` tags which allows to 'plug' the custom tasks.