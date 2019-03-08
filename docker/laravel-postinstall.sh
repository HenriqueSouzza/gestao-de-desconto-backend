#!/bin/bash

export DIR_APP=storage/app/public;
export DIR_LOGS=storage/logs
export DIR_CACHE=storage/framework/cache/data;
export DIR_SESSION=storage/framework/sessions;
export DIR_TEST=storage/framework/testing;
export DIR_VIEW=storage/framework/views;

if [ ! -d "$DIR_APP" ];
then
    echo "Crindo dir: $DIR_APP";
    mkdir -p $DIR_APP;
    chmod -Rf 777 ./;
    chown -Rf root:root ./; 
fi

if [ ! -d "$DIR_LOGS" ];
then
    echo "Crindo dir: $DIR_LOGS";
    mkdir -p $DIR_LOGS;
    chmod -Rf 777 ./;
    chown -Rf root:root ./; 
fi

if [ ! -d "$DIR_CACHE" ];
then
    echo "Crindo dir: $DIR_CACHE";
    mkdir -p $DIR_CACHE;
    chmod -Rf 777 ./;
    chown -Rf root:root ./; 
fi

if [ ! -d "$DIR_SESSION" ];
then
    echo "Crindo dir: $DIR_SESSION";
    mkdir -p $DIR_SESSION;
    chmod -Rf 777 ./;
    chown -Rf root:root ./; 
fi

if [ ! -d "$DIR_TEST" ];
then
    echo "Crindo dir: $DIR_TEST";
    mkdir -p $DIR_TEST;
    chmod -Rf 777 ./;
    chown -Rf root:root ./; 
fi

if [ ! -d "$DIR_VIEW" ];
then
    echo "Crindo dir: $DIR_VIEW";
    mkdir -p $DIR_VIEW;
    chmod -Rf 777 ./;
    chown -Rf root:root ./; 
fi