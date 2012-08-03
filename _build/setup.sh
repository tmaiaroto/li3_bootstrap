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
echo "Installation complete."
echo ""