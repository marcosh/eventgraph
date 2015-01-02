[![Build Status](https://travis-ci.org/marcosh/eventgraph.svg?branch=master)](https://travis-ci.org/marcosh/eventgraph)

eventgraph
==========

an event driven library using a graph database

SCHEMA:

- any TAG has a name and a reference to its first and last event
- any event has a reference to all its tags and, for every tag, a reference to
    the previous and the next event

PREPARE DATABASE:

- create classes

    create class Tag
    create class Event

- create properties 

    create property Tag.name string
    create property Tag.first link Event
    create property Tag.last link Event

    create property Event.name string
    create property Event.ts datetime
    create property Event.tags linkset Tag
    create property Event.prev linkmap Event
    create property Event.next linkmap Event

- create indeces

    create index Tag.name unique