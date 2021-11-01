#!/bin/bash
# Si SELinux -> sudo setenforce Permissive avant lancement du container
cd ..
docker run -ti --rm -v $(pwd):/opt/projet --name exo -u 1000:1000 -p 8000:8000 php/symfony:projet symfony server:start
