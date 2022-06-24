<?php

while (true) {
system("docker stop $(docker ps -a -q);cd Lib; docker build -t jeffcryotistresser:custom .;screen -dms LIBCRYPTOSTRESSER docker run -p 8191:8191 -e LOG_LEVEL=debug jeffcryotistresser:custom");
sleep(600);

}
