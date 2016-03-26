# JoPh Tasks #

This is a set of phing tasks which helps me to develop Joomla! extensions by shortening the phing targets definition
for copying an extension.

By using those tasks it is possible to copy a component (including media and languages for front-end and backend)
with only 1 line of code. This allows to have very simple phing build files which improves project maintanability.

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