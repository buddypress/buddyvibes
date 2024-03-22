#!/bin/bash

# Exit if any command fails
set -e

# Enable nicer messaging for status
YELLOW_BOLD='\033[1;33m';
COLOR_RESET='\033[0m';
status () {
	echo -e "\n${YELLOW_BOLD}$1${COLOR_RESET}\n"
}

wp_path=$1

if [ -z "$wp_path" ]; then
	status "Please provide the absolute path of the WordPress site where BuddyVibes is activated"
	exit
fi

# Check we have a wp-config.php for this WordPress site.
wp_config_path=$(wp config path --path="$wp_path")

started=$(wp post list --name="landing" --post_type="page" --path="$wp_path" --format=csv | tail -n +2)

if [ "$started" ]; then
	status "The starter content is already in place."
	exit
fi

# Create the pages.
landing=$(wp post create ./assets/starter-content/landing.html --post_type=page --post_title=Home --post_name=landing --post_status=publish --porcelain --path="$wp_path")
blog=$(wp post create --post_type=page --post_title=Blog --post_name=blog --post_status=publish --porcelain --path="$wp_path")
community=$(wp post create ./assets/starter-content/community.html --post_type=page --post_title=Community --post_name=community --post_status=publish --porcelain --path="$wp_path")

# Use the landing page as site's home page and the blog one for posts.
wp option update show_on_front page --path="$wp_path"
wp option update page_on_front $landing --path="$wp_path"
wp option update page_for_posts $blog --path="$wp_path"

# Set the custom logo.
logo=$(wp media import ./assets/images/site-logo.png --porcelain --path="$wp_path")
wp option update site_logo $logo --path="$wp_path"

status "The starter content is now in place."
exit
