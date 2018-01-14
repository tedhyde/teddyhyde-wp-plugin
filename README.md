# Teddy Hyde Wordpress Plugin

Easily enable acceptance of micro-contributions in Ethereum on your blog.

## Quick Start

Head over to the releases section, download the latest release as a ZIP, and then upload into your Wordpress plugins.

## Detailed Instructions (DigitalOcean)

DigitalOcean has a dead simple way to create a Wordpress server. Follow these instructions to do a complete installation in under ten minutes.

[Watch the full setup on YouTube](https://youtube.com)

** Steps **
1. Register your domain through any registrar.
1. Go to Digital Ocean and create an account.
1. Make sure to register your SSH public key under "Settings," then "Security"
1. Create a "one-click apps" for Wordpress
1. Establish your network DNS for your new hostname under "Networking". Use the new droplet IP address with '*'.
1. Login via SSH.
1. Install `certbot` using the following commands (https://certbot.eff.org/#ubuntuxenial-apache)
  1. `sudo apt-get update`
  1. `sudo apt-get install software-properties-common`
  1. `sudo add-apt-repository ppa:certbot/certbot`
  1. `sudo apt-get update`
  1. `sudo apt-get install python-certbot-apache`
1. Run certbot to download and install the SSL certificates: `certbot --authenticator standalone --installer apache --pre-hook "apachectl -k stop" --post-hook "apachectl -k start"`
1. Go to your hostname with your browser to complete Wordpress installation.
1. Remember to save your password!
1. Go to the "Releases" section for the Teddy Hyde Wordpress plugin hosted on GitHub: https://github.com/tedhyde/teddyhyde-wp-plugin. Download the latest release as a ZIP file.
1. Go to plugins and "Add New" and then "Upload Plugin". Then, "Activate" the "Teddy Hyde Wordpress" plugin.
1. Register your new blog on Teddy Hyde: https://admin.teddyhyde.com
  1. Make sure to enter in your Ethereum public address into which you want micro-donations to be received.
  1. Choose the amount and currency you prefer (USD or Ethereum)
1. Add a new post.
1. Watch as access to the post is gated by making a micro-donation or watching a blog owner controlled advertisement.
  

