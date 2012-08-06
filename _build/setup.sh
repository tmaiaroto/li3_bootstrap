#!/bin/bash

echo ""
echo "Setting application directory permissions..."
chmod 777 resources -R
chmod 775 config/bootstrap/libraries -R
echo ""

echo ""
echo "Getting all necessary submodules..."
git submodule update --init --recursive
echo ""

echo ""
echo "Creating a symlink to li3 for you..."
chmod +x libraries/lithium/console/li3
ln -s libraries/lithium/console/li3 li3
alias li3='./li3'
echo ""

echo ""
echo "Installation complete."
echo ""