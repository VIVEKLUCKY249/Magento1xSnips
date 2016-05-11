sudo chmod -R 777 /var/www
sudo password: ubuntu123

sudo apt-get update
sudo apt-get install php5-curl

File/Dir copy from one dir to another
sudo cp -R <sourcepath> <destinationpath>
OR
sudo cp -a <sourcepath> <destinationpath>

eg.
sudo cp -R /home/ubuntu/Downloads/events-manager /var/www/html/wp421/wp-content/plugins
then reset root permission with above command

Open in Terminal install
sudo apt-get install nautilus-open-terminal
Restart Nautilus
nautilus -q

Copy and backup original file
cp test.php test.php.orig

sudo mv info.txt config/

To recursively search in subdirectories and list out filenames
grep -rl "string" /path
grep -R pattern /path
grep -R pattern directory

Extract bz2
tar -jxf <filenamewithlocation>.tar.bz2 -C <targetlocation>

Multiple file-type search
grep -nHIrF --include=*.{phtml,js} -- function fblogin (in directory: /run/user/1000/gvfs/smb-share:server=192.168.0.160,share=226/mag/cookpack/)

To recursively search in subdirectories and list out filenames along with line numbers
grep -Hrn "search term" --include \*.<ext> path/to/files
grep -Hrn "Subtotal (Excl. Tax)" --include \*.php .
grep -Hrn "Subtotal (Excl. Tax)" --include \*.php /var/www/226/mag/petstore/
grep -Hrn "Subtotal (Excl. Tax)" --include \*.php /var/www/226/mag/petstore/ >> search_result.txt
mv search_result.txt /var/www/226/mag/
sudo mv search_result.txt /var/www/226/mag/

find /path -type f -exec grep -l "string" {} \;
grep -Rin string *

Example to find string in logs of Pidgin
grep -R '678' /home/ubuntu/.purple/logs/jabber/vivek@192.168.0.30/jayeshkoshiya@192.168.0.30/

Also "find" can be used to find "string"
find dir_path/ -type f -exec grep -H 'string' {} +

Grep with regex pattern
grep -r -e "regex_pattern" path_dir/

mkdir -p ~/.local/share/gedit/plugins
cd ~/.local/share/gedit/plugins
svn checkout http://gedit-intelligent-text-completion.googlecode.com/svn/trunk/gedit3-8/gedit-intelligent-text-completion

Download from external source
wget http://www.magentocommerce.com/downloads/assets/1.9.1.1/magento-1.9.1.1.tar.gz
wget http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/helios/R/eclipse-php-helios-linux-gtk.tar.gz

Download from wget in different folder
wget http://www.magentocommerce.com/downloads/assets/1.9.1.1/magento-1.9.1.1.tar.gz -O /home/ubuntu/Downloads

wget <external_url> -O <path_to_dir>
or
curl -O <external_resource_url>
curl -o <local_path_save> <external_resource_url>

curl -O http://www.magentocommerce.com/downloads/assets/1.9.1.1/magento-1.9.1.1.tar.bz2
curl -O http://www.magentocommerce.com/downloads/assets/1.9.1.1/magento-1.9.1.1.zip

Install ubuntu tweak from terminal
sudo add-apt-repository ppa:tualatrix/ppa
sudo apt-get update
sudo apt-get install ubuntu-tweak

Find non-commented lines (php)
grep "^[^#;/]" <filename>

rm ~/.mozilla/firefox/*.default/*.sqlite ~/.mozilla/firefox/*default/sessionstore.js
rm -r ~/.cache/mozilla/firefox/*.default/*

Local website Pre-installation permissions
sudo chmod -R 777 <targetdir_path>
. means current directory
/ means root directory
~ means home directory

## sudo chmod -R 777 /var/www
## sudo chmod -R 777 /var/www/html/magento1910

Only if local root is in "/opt/lampp/htdocs"
sudo find /opt/lampp/htdocs -type d -exec chmod 755 {} \;
sudo find /opt/lampp/htdocs -type f -exec chmod 644 {} \;

Mine is in "var/www/html"
sudo find /var/www/html -type d -exec chmod 755 {} \;
sudo find /var/www/html -type f -exec chmod 644 {} \;

Magento file/folder permissions reset post installation

sudo find . -type f -exec chmod 644 {} \;
sudo find . -type d -exec chmod 755 {} \;
sudo chmod 550 mage
sudo chmod +x mage

sudo find . -type d -exec chmod 700 {} \;
sudo find . -type f -exec chmod 600 {} \;

find . -type f -exec chmod 400 {} \;
find . -type d -exec chmod 500 {} \;
find var/ -type f -exec chmod 600 {} \;
find media/ -type f -exec chmod 600 {} \;
find var/ -type d -exec chmod 700 {} \;
find media/ -type d -exec chmod 700 {} \;
chmod 700 includes
chmod 600 includes/config.php

Clear terminal window
history -c
history -w
reset
clear

sudo mv fromPath/ toPath/
sudo mv -i fromPath/ toPath/ - for replace prompt

Bash script to move files
#!/bin/bash
mv /path/to/source /path/to/destination

Create multiple nested directories
mkdir -p dir1/dir2....
mkdir -p app/design/frontend/cookpack/default/layout

-if none of the required dirs exist then use:
sudo mkdir -p ~/Create/These/Folders/Within/Each/Other/
sudo mkdir -p ~/Create/These/Folders/Within/Each/Other/

Remove dir
sudo rm -rf <path>

To get your current username
whoami

To get all users in system
cut -d: -f1 /etc/passwd

Change permission of all parent & child dirs in reference to current dir
chown -R user:user {.,}*

To take ownership of "dir"
sudo chown -R <username:group> "dir"
sudo chown <username> -R "dir"

wget http://downloads.activestate.com/Komodo/releases/9.0.1/Komodo-Edit-9.0.1-15745-linux-x86.tar.gz?_ga=1.221993496.1833523751.1432978374

wget http://downloads.activestate.com/Komodo/releases/9.1.0/Komodo-Edit-9.1.0-15798-linux-x86.tar.gz?_ga=1.74111510.545754821.1433742104

To install video converter ffmpeg
sudo add-apt-repository 'deb http://ppa.launchpad.net/jon-severinsson/ffmpeg/ubuntu '"$(cat /etc/*-release | grep "DISTRIB_CODENAME=" | cut -d "=" -f2)"' main' && sudo apt-get update

sudo add-apt-repository ppa:kirillshkrogalev/ffmpeg-next
sudo apt-get update
sudo apt-get install ffmpeg

Video conversion commands

MOV to MP4 maintaining quality lossless
ffmpeg -i <input.mov> -c:v libx264 -crf 19 -preset slow -c:a libfaac -b:a 192k -ac 2 <output.mp4>
ffmpeg -i <input.mov> -c:v libx264 -crf 19 -preset slow -c:a libfaac -b:a 192k -ac 2 <output.mp4>
ffmpeg -i headermovie.mov -c:v libx264 -crf 19 -preset slow -c:a libfaac -b:a 192k -ac 2 headermovie.mp4
ffmpeg -i movie.mov -vcodec copy -acodec copy out.mp4
ffmpeg -i headermovie.mov -vcodec copy -acodec copy headermovie.mp4

ffmpeg -i headermovie.mp4 -s 1280x720 -vpre libvpx-720p -b 3900k -pass 1 \
-an -f webm -y headermovie.webm

ffmpeg -i headermovie.mov -c:v libvpx -crf 10 -b:v 1M -c:a libvorbis headermovie.webm

gst-launch filesrc location=/home/ubuntu/headermovie.mov ! decodebin name=demux ! queue ! ffmpegcolorspace ! vp8enc ! webmmux name=mux ! filesink location=/home/ubuntu/headermovie.webm demux. ! queue ! progressreport ! audioconvert ! audioresample ! vorbisenc ! mux.

Finally handbrake does it!!!
sudo apt-get purge handbrake # remove any old versions
sudo add-apt-repository ppa:stebbins/handbrake-snapshots
sudo apt-get update
sudo apt-get install handbrake-gtk

To increse sudo session duration
sudo visudo
#Scroll down to line "Defaults env_reset"
#Add ",timestamp_timeout=<minutes>" to same line
#Save file & exit

Edit file directly in terminal(eg. /etc/hosts)
"cd /." - To go to root path so any reference is easier
sudo vi <filepath/filename>
Press "Insert" to go into edit mode
After necessary content changes press "Esc" to exit insert mode
Then press ":wq" if not asks to press ! then :wq!
Then type :quit<Enter> to exit Vi editor

Restart Apache server
sudo restart apache2
sudo service apache2 restart

Remove whitespaces leading & trailing
Find: "[ \t]+$ or \s+$"
Replace with: ""
Mode: Regex

/*Replace two or more spaces with single space
Find: "([\s]+)([\s]+)"
Replace with: "\s"
Mode: Regex*/

For installing java installer and Netbeans
sudo apt-get purge openjdk*
sudo add-apt-repository ppa:webupd8team/java
sudo apt-get update
sudo apt-get install oracle-java8-installer

wget http://download.netbeans.org/netbeans/8.0.2/final/bundles/netbeans-8.0.2-php-linux.sh
chmod +x netbeans-8.0.2-php-linux.sh
./netbeans-8.0.2-php-linux.sh

wget http://download.netbeans.org/netbeans/8.0.2/final/bundles/netbeans-8.0.2-linux.sh
chmod +x netbeans-8.0.2-linux.sh
./netbeans-8.0.2-linux.sh

Open all files having a specific text in Geany
eg.
grep -rHIF --exclude='/home/modinfo/bitcoin/*~' -- 'text_to_find' /bin/bash /home/modinfo/bitcoin/* | geany `awk 'BEGIN {FS="[:]"} {print $1}'`

Find and replace in all files from specified path:
find <dir_path> -type f -exec sed -i 's/<oldstring>/<new string>/g' {} \;
grep -rl "<findstring>" <dir_path> | xargs sed -i 's/<findstring>/<replacestring>/g'
grep -rl "<findstring>" <dir_path> | xargs sed -i 's/<findstring>/<replacestring>/g'

--example
find /home/user/directory -name \*.c -exec sed -i "s/cybernetnews/cybernet/g" {} \;
find /var/www/html/vf -type f -exec sed -i "s/Elite/Perception/g" {} \;

From current dir
find ./ -type f -readable -writable -exec sed -i "s/cybernetnews/cybernet/g" {} \;
--example
find ./ -type f -readable -writable -exec sed -i "s/Elite/Perception/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/elite/perception/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/Thisweekmeals/Copyproducts/g" {} \;

Find in files in dir
whole word match
grep -rnw 'directory' -e "pattern"

show only filenames
grep -rnl 'directory' -e "pattern"
show filenames & lines having string
grep -rn /var/www/html/Perception -e Elite
grep -rnl /var/www/html/frontend_layouts/vf -e Elite_

grep -rnl /var/www/html/frontend_layouts/vf -e Elite_
grep -rn /var/www/html/frontend_layouts/vf -e elite_
grep -rn /var/www/html/frontend_layouts/vf -e elite
grep -rn /var/www/html/frontend_layouts/vf -e Elite

grep -rnl Elite_ /var/www/html/frontend_templates/vf | xargs sed -i "s/Elite_/Perception_/g"
grep -rnl Elite_ /var/www/html/frontend_layouts/vf | xargs sed -i "s/Elite_/Perception_/g"

grep -rni "elite_" .
grep -rn "elite_" . | xargs sed -i "s/elite_/perception_/g"
grep -rni "elite" . | xargs sed -i "s/elite/perception/g"

grep -r -l 'searchtext' . | sort | uniq | xargs perl -e "s/searchtext/replacetext/" -pi

Case insensitive
will show only filenames not lines containing string
grep -rnil /var/www/html/Perception -e elite

will show only filenames and lines containing string
grep -rni /var/www/html/Perception -e elite


Rename multiple files inside current active directory
rename 's/ACDC/AC-DC/' *.xxx
-remove extensions from filenames
rename 's/\.bak$//' *.bak
-convert lower case names to uppercase
rename 'y/a-z/A-Z/' *
--Example
rename 's/Elite/Perception/' *.xml

FIND AND REPLACE IN MULTIPLE FILES INSIDE DIRCTORY
grep -rl Sns Sns/ | xargs sed -i 's/Sns/Perc/g'
sed -i 's/Sns/Perc/g' *.xml
find ./ -type f -readable -writable -exec sed -i "s/Darsh/Darshnew1/g" {} \;
grep -Hrn 'search term' path/to/files
eg. grep -Hrn 'Elite_' .
eg. grep -Hrn 'Perception_' .
Note: . means current directory

Compression commands
Tar.xz max compression ratio
tar -cf - <dir_name> | xz -9 -c - > <file_name>.tar.xz
--example
tar -cf - foo/ | xz -9 -c - > foo.tar.xz

tar -czpf /home/me/somefile.tar.gz /path/to/files/to/be/archived
tar jxvf <filename>.tar.bz2
sudo apt-get install unrar
sudo apt-get install unzip

zip "archive-$(date +"%Y-%m-%d").zip" file1 file2 file3
zip "<archive_name>-$(date +"%Y-%m-%d").zip" <path>

zip -r "<archive_name>-$(date +"%Y-%m-%d").zip" <path>
zip -r "<archive_name>_$(date +"%d-%m-%Y").zip" <path>

sudo zip -r "cookpack-$(date +"%Y-%m-%d").zip" cookpack/
zip -r "cookpack_$(date +"%Y-%m-%d").zip" cookpack/
zip -r "cookpack-$(date +"%d-%m-%Y").zip" cookpack/

sudo zip -r "store-perception-$(date +"%Y-%m-%d").zip" store-perception/

Always provide super-user permissions before compressing
sudo chmod -R 777 varsitycoop/
sudo zip -r "varsitycoop-$(date +"%Y-%m-%d").zip" varsitycoop/

unzip <nameofzipfile>
unzip <nameofzipfile> -d <extract-in-folder>


To set compression level (1 to 9 so far)
bzip2 -<compression_level_value>
gzip -<compression_level_value>

tar cvf archive.tar [directory to be tarred]
Then I used the bzip2 command directly on the tarball:
Code:
bzip2 -kv9 archive.tar
bzip2 -kv9 cookpack_17062015.tar
-k preserve old uncompressed tarball

Find and delete all files with particular extension
find . -name "*.bak" -type f
find . -name "*.bak" -type f -delete

find . -name "*.htm~" -type f
find . -name "*.htm~" -type f -delete

To install ".deb" file do following:
	So if you have a .deb file:

    You can install it using sudo dpkg -i /path/to/deb/file followed by sudo apt-get install -f .
    You can install it using apt-get install package_name . But first move your deb file to /var/cache/apt/archives/ directory. ...
    Install gdebi and open your .deb file using it (Right-click -> Open with).

sudo dpkg -i /path/to/deb/file followed by sudo apt-get install -f

Composer necessary commands:
curl -sS https://getcomposer.org/installer | php -- --install-dir=/var/www/composer_dir
composer update
composer self-update

Take ownership of $HOME path
sudo chown -hvR <user> /home/<user>
sudo chown -R testuser1:testuser1 /home/testUser1
sudo chown -R testuser2:testuser2 /home/testUser2
sudo chown -R testuser3:testuser3 /home/testUser3

To check all disk's usage info:
df -h

To check specific disk's usage info
df -h <drive path>
eg. df -h /dev/sda8 (for /home dir)

Find all directories by name <dir_name> starting from specified directory and print their paths: (default Case sensitive)
Notes:
"." means current directory
"~" means Home directory (/ubuntu/home)
find <starting_directory> -type d -name "*<dir_name>*" -print
--example--
find ~ -type d -name "*99966*" -print
find . -type d -name "*Perception*" -print

--with OR--
-name "*.xyz" OR (-name "*.abc" AND -exec ...)

To remove found directories recursively
find . -name <dir_name> -type d -print0|xargs -0 rm -r --
--example--
find . -name test -type d -print0|xargs -0 rm -r --
--same as xargs--
find . -name test -type d -exec rm -r {} +
find . -name test -type d -exec rm -r {} \;

wget https://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/mars/R/eclipse-php-mars-R-linux-gtk.tar.gz&mirror_id=105

Recursively rename files & directories inside a specific directory
cd to dir then
find . -name '123*.txt' -type f -exec bash -c 'mv "$1" "${1/\/123_//}"' -- {} \;
find . -name 'Thisweekorders.php' -type f -exec bash -c 'mv "$1" "${1/\/Mealplansubscribers//}"' -- {} \;

find . -iname "Thisweekorders.*" -exec rename "Thisweekorders" "Mealplansubscribers" '{}' \;

find . -depth -type d -not -name '.' -exec rename 's/(.*)/$1_foo/' {} +
find . -depth -type d -not -name '.' -exec rename 's/Clarion/Perception/' {} +

!!working :)
find /home/ubuntu/Desktop/Mealplansubscribers -type f -exec rename 's/Thisweekorders/Mealplansubscribers/' '{}' \;
find /home/ubuntu/Desktop/Mealplansubscribers -type d -execdir rename 's/Thisweekorders/Mealplansubscribers/' '{}' \;

find <path_to_dir> -type f -exec rename 's/<oldfilename>/<newfilename>/' '{}' \;
find <path_to_dir> -type d -execdir rename 's/<olddirname>/<newdirname>/' '{}' \;

--or by 'shopt'(bash --version > 4)
shopt -s globstar
rename -n 's/special/regular/' **

MySQL Create gzip compressed mysql-dump file
mysqldump --opt <database> | gzip -c | ssh user@wherever 'cat > /tmp/yourfile.sql.gz'

Ubuntu Create "tar.gz" of single folder
sudo tar -czf <file-name.tar.gz> <foldername/path_to_folder>
Ubuntu Create "tar.gz" of multiple folders
sudo tar -czf <file-name.tar.gz> <folder1/path_to_folder1> <folder2/path_to_folder2> <folder3/path_to_folder3>...
(Note: 'folder' can be directory or file name).

tar cf - <source folder> | 7z a -si <Destination archive>.tar.7z
tar cf- $HOME | my_compression_program >/tmp/compressed.output

To compress any project on 160 pc
cd /var/www/226/mag
sudo tar -czf <projectname>.tar.gz <projectfoldername>/
--enter password if prompted--

Ubuntu compress(zip) any folder
zip -r <filename>.zip <foldername>
zip -r skin.zip skin/
with permission override
sudo zip -r <filename>.zip <foldername>/
sudo zip -r skin.zip skin/
sudo zip -r app.zip app/

FIND AND REPLACE IN MULTIPLE FILES IN SIDE DIRCTORY
grep -rl Sns Sns/ | xargs sed -i 's/Sns/Perc/g'
in current directory
sed -i 's/Sns/Perc/g' *.xml

Compress to zip from current directory
zip -r cookpack.zip cookpack/
zip -r <foldername>.zip <foldername>/
Compress to zip from anywhere
zip -r <customname>.zip <path_to_foldername>/

Reset Permissions for Magento
find ./ -type f | xargs chmod 644
find ./ -type d | xargs chmod 755
chmod +x mage
chmod 550 pear

Add user to group to get all rights and permissions
sudo adduser <username> <groupname>
sudo adduser ubuntu www-data

Ubuntu Update Google Chrome to Latest available version

Uninstall Chrome
sudo apt-get remove google-chrome-stable
sudo apt-get purge google-chrome-stable
sudo apt-get autoremove
--Optional to remove plugins
rm ~/.config/google-chrome/ -rf

Install latest Chrome (x86 system)
sudo apt-get install libxss1 libappindicator1 libindicator7
wget https://dl.google.com/linux/direct/google-chrome-stable_current_i386.deb
sudo dpkg -i google-chrome*.deb

Install latest Chrome (x64 system)
sudo apt-get install libxss1 libappindicator1 libindicator7
wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
sudo dpkg -i google-chrome*.deb

Chrome repo
http://www.ubuntuupdates.org/ppa/google_chrome

Vim Commands Set
Hit the Esc key; that goes into command mode. Then you can type
	:q to quit (short for :quit)
	:q! to quit without saving (short for :quit!)
	:wq to write and quit (think write and quit)
	:wq! to write and quit even if file has only read permission (if file does not have write permission: force write)
	:x to write and quit (shorter than :wq)
	:qa to quit all (short for :quitall)

When you press :, a : will appear at the bottom of the screen.

Or you can press Esc ZZ (Esc Shift+Z Shift+Z) to write/save if the file was changed, then quit.

Or if you don't want to save changes you can use ZQ instead.

Vim has extensive help, so type Esc:helpReturn and you will have all your answers and even a neat tutorial.

Get Internal Ip of Ubuntu system
ip route get 8.8.8.8 | awk '{print $NF; exit}'
ifconfig | perl -nle'/dr:(\S+)/ && print $1'
hostname -I

Compress & Extract any kind of method
sudo apt-get install p7zip-full

PHPMyAdmin DB Export
@DATABASE@_%Y-%m-%d
@DATABASE@_%Y-%m-%d

__DB__-%F-%T
or for newer version of phpMyAdmin
@DATABASE@-%F-%T

Check if system is 32bit or 64bit
uname –a
uname –m
eg. x86_64 - 64bit
		i386/i686 - 32bit

MySQL Dump Options and Parameters
Export:
mysqldump -u root -p --all-databases > alldb.sql
mysqldump -u root -p --all-databases | gzip > alldb.sql.gz
Look up the documentation for mysqldump. You may want to use some of the options mentioned in comments:
mysqldump -u root -p --opt --all-databases > alldb.sql
mysqldump -u root -p --all-databases --skip-lock-tables > alldb.sql
Import:
mysql -u root -p < alldb.sql

Magento Customer address override translation in csv:
"Mage_Sales::Sold to:","Fakturaadresse:"
"Mage_Catalog::Add to Wishlist","Toevoegen aan favorieten"

Magento 2 specific commands for Ubuntu

Composer Related commands:
https://getcomposer.org/download/
composer install
composer update
or by PHP
curl -sS https://getcomposer.org/installer | php
curl -sS https://getcomposer.org/installer | php -- --install-dir=bin -> For installing into "bin" dir
curl -sS https://getcomposer.org/installer | php -- --filename=<filename> -> For downloading as file with custom name <filename>
php -r "readfile('https://getcomposer.org/installer');" | php
php composer.phar install
php composer.phar update
composer.phar self-update

Define custom environment variable:
export MAGE2BIN=/var/www/html/magento-2/bin
echo $MAGE2BIN

Get the rest of the libraries from last step:
php bin/magento setup:static-content:deploy

Enable/disable module from command-line:
php -f index.php -- module-disable --modules=Vendor_Module - Disable
php -f index.php -- module-enable --modules=Vendor_Module - Enable
php -f index.php -- update

magento module:enable [-c|--clear-static-content] [-f|--force] [--all] <module-list>
magento module:disable [-c|--clear-static-content] [-f|--force] [--all] <module-list>

Delete multiple folders in a common parent
rm -rf var/{view_preprocessed,generation,cache,page_cache,composer_home}
magento module:disable Perception_Hellow
magento module:enable Perception_Hellow
php -f bin/magento module:enable --clear-static-content Vendor_Module
php -f bin/magento module:enable --clear-static-content Perception_Hellow
php -f bin/magento module:disable -c Magento_Bannerslider
php -f bin/magento setup:upgrade
php -f bin/magento setup:di:compile

Get modules list of current installed modules:
php -f index.php -- help module-list

Run multiple commands in one line:
Hint: Use && between multiple commands with space
Note: '.' means current directory
Note: '..' means parent directory of current directory

Move Up one directory or go to parent
cd .. && sudo chmod -R 777 <root_dirname>/

Move Up two directories
cd ../.. && sudo chmod -R 777 <root_dirname>/

Move Up three directories
cd ../../.. && sudo chmod -R 777 <root_dirname>/

cd /var/www/html/<root_dirname> && sudo chmod -R 777 <root_dirname>/
cd /var/www/html/<root_dirname> && sudo chmod -R 777 .

sudo ln -s /usr/share/phpmyadmin /var/www/html

echo "date.timezone = Europe/Berlin" >> /etc/php5/cli/php.ini
echo "date.timezone = Europe/Berlin" >> /etc/php5/apache2/php.ini

sudo echo "date.timezone = Europe/Berlin" >> /etc/php5/cli/php.ini

echo "output" | sudo tee -a file
echo "date.timezone = Europe/Berlin" | sudo tee -a /etc/php5/cli/php.ini
echo "date.timezone = Europe/Berlin" | sudo tee -a /etc/php5/apache2/php.ini

Get list of files that are modified within timeframe
find ./ -mmin -360

Cache clean for Magento 2.0.0
sudo php bin/magento cache:clean
sudo php -f bin/magento cache:clean

Firefox Tweaks for Faster Browsing and Downloads

Type 'about:config' and press Enter

Search for "browser.cache.use_new_backend" and set it to "1".
Search for "browser.cache.use_new_backend_temp" and set it to "true".

Search for below values and set their values as given

Set "network.http.pipelining" to "true"
Set "network.http.proxy.pipelining" to "true"
Set "network.http.pipelining.maxrequests" to some number like 1000.
network.dns.disableIPv6: set "false"
"content.notify.backoffcount": set "5"; (Five)
"plugin.expose_full_path": set "true".
"ui.submenuDelay": set "0; (zero)
"config.trim_on_minimize" to "true".

Note: -R means recursive generally
Install ".deb" package files with their dependencies in very easy way and least steps
- Original package install
sudo dpkg -i /path/to/filename.deb
Or
sudo dpkg -i -R /path/to/filename.deb
- Dependencies Upgrade and Install
sudo apt-get -f install

Remove software completely
sudo apt-get purge --auto-remove <packagename>
sudo apt-get --purge remove <packagename>
apt-get remove <packagename>
sudo apt-get purge --auto-remove bleachBit

Google No Country Redirect
https://www.google.com/?gws_rd=cr
https://www.google.com/?gws_rd=cr

sudo zip -r "varsitycoop-$(date +"%Y-%m-%d").zip" varsitycoop/

Firefox reinstall process
Quit Firefox Effectively

First make sure Firefox is not running:

ps ax | grep [f]irefox

If it is running, quit it. If it doesn't appear to be running but appears in the list from ps ax, kill it by running killall firefox, waiting a few seconds, then running killall -KILL firefox. If you don't see firefox: no process found after the second killall command, run that second command again. If you still don't see it, reboot (or you may want to try running it with sudo too, thought that won't usually help).
Consider Clearing Your Profile

If you want to clear out your profile (which can fix many problems, especially probems relating to upgrading Firefox to a new version), then rename the folder called .mozilla that resides in your home folder. There's two ways to do this:

    In Nautilus (the GUI file browswer): Press Ctrl+H or click View > Show Hidden FIles. Then you can see files and folders that start with a .. Go to your home folder if you're not already there, and rename .mozilla to .mozilla.old (or whatever you want to call it).

    On the command-line: Open a Terminal window (Ctrl+Alt+T) and run the command:

    mv ~/.mozilla ~/.mozilla.old

    (Or put whatever you want to call it, in place of .mozilla.old.)

The idea behind renaming the folder instead of deleting it is so you can restore it. But if its contents are keeping Firefox (or a recently installed newer version of Firefox) from working, then you may have trouble actually using them later!

Therefore, if there's anything you want to save--often, this will be your bookmarks--you should back that up first, before you do this. (This article may help with that.)

Finally, note that I'm certainly not advocating clearing your profile regularly, or even every time you upgrade Firefox. It's only when you have severe problems after upgrading that I recommend trying it. (If it makes no difference, you can rename .mozilla.old back to .mozilla--you may have to remove a newly created .mozilla first. That's one of the reasons to back up the whole profile.)
Reinstall Firefox (from the latest version in any of your software sources)

To reinstall Firefox, removing global configuration files and getting the latest version available in any of the software sources configured on your Ubuntu system, run:

sudo apt-get update
sudo apt-get --purge --reinstall install firefox

Should apt-get upgrade be run too?

Running sudo apt-get upgrade is not necessary for getting the latest available Firefox, because the install command will automatically fetch and install or upgrade to the latest installable version, and whatever other packages (if any) are needed to enable that version to install.

With that said, it's reasonable to run sudo apt-get upgrade in this situation. You may want to bring all your software up to date, and that can even potentially help with some interoperabilty problems. (New versions of some packages and really old versions of others have not necessarily been tested together, after all.)

If you're accustomed to using the Software Updater (Update Manager in older Ubuntu releases), go ahead and do that. If you prefer to use the command-line:

sudo apt-get upgrade
sudo apt-get dist-upgrade

Of course, if you haven't run sudo apt-get update shortly before running those, you should do that. And sudo apt-get dist-upgrade will upgrade packages that require the installation of new packages or removal of currently installed packages, so you should make sure to look at what it says it plans to do, before letting it proceed.

(To address a common confusion: dist-upgrade does not attempt to upgrade your Ubuntu system to a later Ubuntu release, though on some other OSes it's used for that purpose in combination with manually editing a configuration file. See this explanation of dist-upgrade. Running sudo apt-get update, sudo apt-get upgrade, and sudo apt-get dist-upgrade in that order approximates the behavior of the Software Updater / Update Manager and tends to work well.)

Video convert from mp4 to ogg
ffmpeg -i <input_video.mp4> -vcodec libtheora -acodec libvorbis -ab 128k -b 350k <output_video.ogg>
ffmpeg -i tagmeapp-video.mp4 -vcodec libtheora -acodec libvorbis -ab 128k -b 350k tagmeapp-video.ogg

Clear and Reset Terminal Completely
history -c && history -w && clear && reset;
history -c && history -w && clear;

shopt -s globstar
rename -n 's/special/regular/' **

shopt -s globstar
rename -n 's/Magestore/Perception/' **

Ubuntu Install Atom 32bit
sudo add-apt-repository ppa:webupd8team/atom
sudo apt-get update
sudo apt-get install atom

Grep with filetype matching (. means current directory and / means root folder)
grep -nr --include="*.<file_extension>" "<text/pattern>" <directory/path>
grep -nr --include="*.html" "onblur" .
grep -nr --include="*.phtml" "stickylogo" .