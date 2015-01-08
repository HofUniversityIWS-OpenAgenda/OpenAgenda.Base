#!/bin/sh
rm -r out
node_modules/.bin/jsdoc -c jsdoc.json -r

if [[ "$OSTYPE" == "darwin"* ]]; then
        open out/index.html
else
        echo "Not supported"
fi