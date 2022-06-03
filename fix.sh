#!/bin/bash
##
# By Aslam
# aslam@bpract.com
#
# See README or code below for usage
##

# Colors
red='\033[0;31m'
green='\033[0;32m'
yellow='\033[1;33m'
blue='\033[1;34m'
NC='\033[0m' # No Color

BOLD='\033[1m'
UNDERLINE='\033[4m'


box_out()
{
  local s=("$@") b w
  for l in "${s[@]}"; do
    ((w<${#l})) && { b="$l"; w="${#l}"; }
  done
  tput setaf 3
  echo " -${b//?/-}-
| ${b//?/ } |"
  for l in "${s[@]}"; do
    printf '| %s%*s%s |\n' "$(tput setaf 4)" "-$w" "$l" "$(tput setaf 3)"
  done
  echo "| ${b//?/ } |
 -${b//?/-}-"
  tput sgr 0
}


# Help menu
print_help() {
	cat <<-HELP

		This script is used to fix permissions of the laravel installation and fixes the common issues.

		1) Path to your Laravel installation.
		2) This will choose current user for ownership over files.
		2) This script assumes the httpd_group is www-data
		
		Usage:  bash ${0##*/} 


	HELP
	exit 0
}

sudo chown cloud:cloud fix.sh

# if current user is root, and forceroot is set to true , then pass ask confirm perm change 
# func perm_change dir user  
# if current user is root, and no forceroot set or forceroot is set to no then pass to root user options function
# func root_user_options dir  
	# Set to forceroot and true if choose root again
# if current user is not root; then pass to ask confirm perm chnge;
# func perm_change dir user  
	
#1 - check_if_current_dir_is_laravel() - current directory
check_if_laravel_installation() {

	printf "${green}Checking whether you are inside a laravel installation...\n\n${NC}"

	if [ $1 ]; then
		box_out "Checkig against the path you provided : "$1"";
	fi
	if [ ! -z $1 ] && [ -d $1"/bootstrap" ] && [ -f $1"/.env" ]; then
		cd $1
		box_out "Cool! now we're inside your laravel application" 

		user_checker $1 $2 $3
		
		exit 1
		
	else
		box_out "Seems like you are outside a laravel instalation and you have not specified a valid path.." "Type the path to your laravel installation. Use a full path. Example: /var/www/my-laravel-project/ .."
		read -p "Type the path to your laravel installation `echo $'\n> '`" laravel_path
		check_if_laravel_installation $laravel_path $USER
		exit 1
	fi
}

user_checker() {

	# if current user is root, and forceroot is set to true , then pass ask confirm perm change 
	# func perm_change dir user  
	# if current user is root, and no forceroot set or forceroot is set to no then pass to root user options function
	# func root_user_options dir  
		# Set to forceroot and true if choose root again
	# if current user is not root; then pass to ask confirm perm chnge;
	# func perm_change dir user  
	

	if [[ $USER = "root" ]] && [[ $3 = "forceroot" ]] ; then 
		confirm_permission $PWD $USER
	elif [[ $USER = "root" ]] && [[ $3 != "forceroot" ]] ; then 
		#statements

		box_out "You are running this script as root" "and it is NOT RECOMMENTED for root user to own the files and dierctories in laravel application!"
		while true; do		
		read -p "Do you want to select another user in system? Press Y for Yes, N for No, and C for creating new user `echo $'\n> '`" ync		
		case $ync in
			[Yy]* ) 
				box_out 'You choose to select another existing user in system.'
			
				if read -p "Type the username `echo $'\n> '`" username_get; then
				if [ -z "$username_get" ] || [ ! $(getent passwd $username_get) ]; then		
					printf "Please provide a valid user.\n"
					user_checker 
					exit 1
				else
					confirm_permission $PWD $username_get
				fi
				#statements
				return 
				fi
				break;;
			[Nn]* ) 
				box_out 'You choose no.'
				while true; do
				read -p "Are you sure you want to assign root user?? Its dangerous! Y/N? : `echo $'\n> '`" yn
				case $yn in
					[Yy]* ) 
						box_out 'Forcing root to own files and directories!'; 
						confirm_permission $PWD $2 
						break;;
					[Nn]* ) 
						box_out 'Thats cool! lets go to the previous step.'; 
						check_if_laravel_installation $PWD $2	
						break;;
						* ) 
						box_out "Please answer yes OR no";;
					esac
				done
				exit 1
				exit;;
			[Cc]* ) 
				box_out 'You choose create user option.'
				while true; do
				read -p "Are you sure you create a user? Y/N? : `echo $'\n> '`" yn
				case $yn in
					[Yy]* ) 
						box_out 'Creating user'; 
						create_user $PWD  
						break;;
					[Nn]* ) 
						box_out 'Fine, Lets not create a user then. Going back to previous step.'; 
						check_if_laravel_installation $PWD $2	
						break;;
						* ) 
						box_out "Please answer yes OR no";;
					esac
				done
				exit 1
				exit;;
		esac
		done

	elif [[ $USER = "root" ]] && [[ -z "$username_get" ]] && [[ ! $(getent passwd $username_get) ]]; then	

		printf "Please provide a valid user.\n"
		if read -p "Type the username `echo $'\n> '`" username_get; then
			if [ -z "$username_get" ] || [ ! $(getent passwd $username_get) ]; then		
				printf "Please provide a valid user .\n"
				
				user_checker 
				exit 1
			else
				confirm_permission $PWD $username_get
			fi
		fi
		exit 1
	elif [[ ! $USER = "root" ]] ; then
		confirm_permission $PWD $USER

	else
		exit 0
	fi

	
}

create_user(){
	#!/bin/bash
	# Script to add a user to Linux system
	if [ $(id -u) -eq 0 ]; then
		read -p "Enter username : " username
		read -s -p "Enter password : " password
		egrep "^$username" /etc/passwd >/dev/null
		if [ $? -eq 0 ]; then
			echo "$username exists!"
			exit 1
		else
			pass=$(perl -e 'print crypt($ARGV[0], "password")' $password)
			useradd -m -p $pass $username
			[ $? -eq 0 ] && echo "User has been added to system!" && user_checker $PWD $username || echo "Failed to add a user!"
		fi
	else
		echo "Only root may add a user to the system"
		exit 2
	fi
}



confirm_permission(){

	printf "\n\n"
	printf "${green}${BOLD}PATH : '$1' | USER : '$2'  ${NC}\n\n"
	
	


	while true; do
	read -p "This action will assign permissions and ownership for the files inside the laravel installation. 
Are you sure to proceed? Y/N? : `echo $'\n> '`" yn
	case $yn in
	[Yy]* ) 
		permissions_changer $1 $2
		break;;
	[Nn]* ) 
		box_out 'Okay! Thanks for using this script!'; 
		exit 1	
		break;;
		* ) 
		box_out "Please answer yes OR no";;
	esac
	done

}


permissions_changer (){


	laravel_path=$1  
	laravel_user=$2
	httpd_group='www-data'


	

	# Start changing permissions
	printf "Changing ownership of all contents of \"${laravel_path}\":\n user => \"${laravel_user}\" \t group => \"${httpd_group}\"\n\n"
	sudo chown -R ${laravel_user}:${httpd_group} .
	
	printf "Changing permissions of all directories inside \"${laravel_path}\" to \"rwxr-x---\" except storage with subfolders and bootstrap cache folder and except .git folders ... \n\n"
	sudo find . -type d -not -path "./storage" -not -path "./storage/*" -not -path "./bootstrap/cache" -not -name ".git" -exec chmod u=rwx,g=rx,o= '{}' \+
	
	printf "Changing permissions of all files inside \"${laravel_path}\" to \"rw-r-----\" except .env and bootstrap cache folder and except name .gitignore...\n\n"
	sudo find . -type f -not -path "./.env" -not -path "./storage/*" -not -name ".gitignore" -exec chmod u=rw,g=r,o=r '{}' \+
	
	printf "Changing permissions of \"storage\" directory in \"${laravel_path}/storage\" to \"rwxrwx---\"...\n\n"
	cd ${laravel_path}/storage
	sudo find . -type d -exec chmod ug=rwx,o= '{}' \+
	
	printf "Changing permissions of all files inside \"storage\" directories in \"${laravel_path}\" to \"rw-rw----\"...\n\n"

	printf "Changing permissions of all directories inside \"storage\"directory in \"${laravel_path}\"${yello} to \"rwxrwx---\"...\n\n"

	printf "Changing permissions of various Laravel text files in \"${laravel_path}\" to  \"rwx------\"...\n\n"
	
	cd ${laravel_path}
	sudo chmod u=rwx,go= package.json readme.md composer.json
	printf "Enable executing node_modules in \"${laravel_path}\" to \"rwx------\" (Which is necessary for running npm run as the current user.)...\n\n"
	
	cd ${laravel_path}
	sudo chmod -R a+x node_modules
	printf "Giving the newly created files/directories the group of the parent directory - \"${laravel_path}\"...\n\n"
	
	cd ${laravel_path}
	sudo find ./bootstrap/cache -type d -exec chmod g+s {} \;
	sudo find ./storage -type d -exec chmod g+s {} \;
	printf "Letting newly created files/directories inherit the default owner  - \"${laravel_path}\"...\n\n"
	## permissions up to maximum permission of rwx e.g. new files get 664, 
	## folders get 775
	
	# cd ${laravel_path}
	# sudo setfacl -R -d -m g::rwx storage;
	# sudo setfacl -R -d -m g::rwx bootstrap/cache;
	
	printf "Enable executing node_modules in \"${laravel_path}\" to \"rwx------\"...\n\n"
	cd ${laravel_path}
	sudo chmod -R a+x node_modules


	printf "Storage folder issues in \"${laravel_path}\" \n\n"
	cd ${laravel_path}
	sudo setfacl -Rm u:${httpd_group}:rwx,u:${laravel_user}:rwx storage
	
	echo "Done setting proper permissions on files and directories\n\n"
	optimize_laravel ${laravel_path}
	sudo chown cloud:cloud ${laravel_path}'/fix.sh'
}


optimize_laravel() {
	cd $1
	printf "\n"
	php artisan key:generate;
	printf "\n"
	php artisan cache:clear	
	printf "\n"
	php artisan view:clear
	printf "\n"
	php artisan config:cache
	printf "\n"	
	php artisan currency:update -o
	printf "\n"
	printf "Fixed permissions and tweaked common problems. Best of luck! \n"
}


if [ -z "$2" ] || [ ! $(getent passwd $2) ]; then
	check_if_laravel_installation $PWD $USER
else
	check_if_laravel_installation $PWD $2	
fi


