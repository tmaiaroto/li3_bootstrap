#!/bin/bash

echo ""
echo "Welcome to Lithium Bootstrap!"
echo "----------------------------------"
echo ""
echo "Starting the installation process, hold on to your butts..."
echo ""

exec git clone git://github.com/tmaiaroto/li3_bootstrap.git .
clear;
exec _build/setup.sh;