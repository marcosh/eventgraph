[![Build Status](https://travis-ci.org/marcosh/eventgraph.svg?branch=master)](https://travis-ci.org/marcosh/eventgraph)
[![Coverage Status](https://img.shields.io/coveralls/marcosh/eventgraph.svg)](https://coveralls.io/r/marcosh/eventgraph)
[![Dependency Status](https://www.versioneye.com/user/projects/54bbcf4a879d5170010001a2/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54bbcf4a879d5170010001a2)
[![Code Climate](https://codeclimate.com/github/marcosh/eventgraph/badges/gpa.svg)](https://codeclimate.com/github/marcosh/eventgraph)

eventgraph
==========

an event driven library using a graph database

SCHEMA:

- any TAG has a name and a reference to all its events
- any event has a reference to all its tags

PREPARE DATABASE:

- create classes

    create class Tag
    create class Event

- create properties

    create property Tag.name string
    alter property Tag.name mandatory = true
    create property Tag.history linklist Event

    create property Event.name string
    alter property Event.name mandatory = true
    create property Event.ts datetime
    alter property Event.ts mandatory = true
    create property Event.tags linkset Tag

- create indeces

    create index Tag.name unique

OPERATIONS:

- create a new Tag with a given name
- create a new Event associated to some tags
- retrieve a tag first event, last event or complete history
- retrieve the previous or next event of an event with respect to a given tag