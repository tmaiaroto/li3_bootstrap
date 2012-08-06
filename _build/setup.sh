#!/bin/bash

echo ""
echo "Setting application directory permissions..."
chmod -R 777 resources
chmod -R 775 config/bootstrap/libraries
echo ""

echo ""
echo "Getting all necessary submodules..."
git submodule update --init --recursive
echo ""

echo ""
echo "Installation complete."
echo ""