# JoPh Tasks

[![Build Status](https://travis-ci.org/jlainezs/JoPhTasks.svg?branch=master)](https://travis-ci.org/jlainezs/JoPhTasks)

This is a set of phing tasks which helps me to develop Joomla! extensions by shortening the phing targets definition
for copying an extension.

By using those tasks it is possible to copy a component (including media and languages for front-end and backend)
with only 1 line of code. This allows to have very simple phing build files which improves project maintanability.

## Tasks

The tasks defined allows you to copy:

* Components
* Modules
* Plugins
* Templates

from your coding directory to the local Joomla installation you are using for development. Of course, those tasks
can help if you develop your extensions outside of the Joomla installation folders.

## Install

Add ```"econceptes/joomla-phing-tasks" : ">=1.0.1beta"``` to your project composer.json require section and execute a
```composer install``` command.

## How to use it

The ```build.xml``` file on the ```simple-project``` directory is a good example to get an idea of how to use those tasks.
The most important part is the ```<includepath>``` and ```<taskdef>``` tags which allows to 'plug' the custom tasks into Phing.
Don't forget to adjust the path of ```<includepath>``` on your project phing build file to match your settings. Usually
the package is installed under ```vendor/econceptes/joomla-phing-tasks``` (tasks are inside the folder ```tasks```).

## Change log

* v1.0.5beta: extensions language folder can be written un plural (languages) or singular (language)