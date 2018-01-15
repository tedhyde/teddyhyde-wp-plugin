# Teddy Hyde Wordpress Plugin

The simplest and most secure way to accept Ethereum contributions on your WordPress blog. 

## Features and Benefits

1. **Setup is easy** (eight minutes from zero to full Wordpress install, see below) 
    1. Add the plugin to WordPress.
    2. Configure your site on https://admin.teddyhyde.com
3. **Readers pay immediately** on your site for access to content (no special browser or plugins required and works on any mobile browser) or (only if you permit it) they can choose to watch an advertisement in lieu of payment. 
3. **Readers never leave your site**
3. **Setup (for your readers) is a one-time transaction** that happens immediately and takes 15 seconds.
3. **Contributions can come from anywhere in the world** (readers only need Internet access).
3. **No credit card** is required.
3. **Transactions are peer-to-peer**: the reader is generating a payment transaction from your website and that transaction can be processed entirely by you (but Teddy Hyde will do it for free if you prefer). Transactions are logged so you can see your success rates.

**Why is Teddy Hyde better/safer/simpler than other solutions?**

* **Patreon**: your content is hosted on your site so you don't have to expend energy building Patreon's brand (and worry they will change their policies and kick you off the landing page you've built).
* **Tipping services**: users cannot access the content until they pay or you permit them access after watching an ad.
* **Stripe**: no account approval process is required, no credit card information changes hands, no PCI compliance is required.

## Quick Start

Head over to the releases section, download the latest release as a ZIP, and then upload into your Wordpress plugins. 

**NB**: Your WordPress server must be on HTTPS (SSL) so if you don't have this established, read below on how to setup easily with certbot from "Let's Encrypt".

## Detailed Instructions (DigitalOcean)

DigitalOcean has a dead simple way to create a Wordpress server. Follow these instructions to do a complete installation in under ten minutes.

[Watch the full setup on YouTube](https://youtu.be/0LNZajf3fr0)

**Steps**
1. Register your domain through any registrar.
1. Go to Digital Ocean and create an account.
1. On DigitalOcean...
   1. Make sure to register your SSH public key under "Settings," then "Security"
   1. Create a "one-click apps" for Wordpress
   1. Establish your network DNS for your new hostname under "Networking". Use the new droplet IP address with '*'.
1. Login to your droplet via SSH.
   1. Install `certbot` using the following commands (https://certbot.eff.org/#ubuntuxenial-apache)
      1. `sudo apt-get update`
      1. `sudo apt-get install software-properties-common`
      1. `sudo add-apt-repository ppa:certbot/certbot`
      1. `sudo apt-get update`
      1. `sudo apt-get install python-certbot-apache`
   1. Run certbot to download and install the SSL certificates: `certbot --authenticator standalone --installer apache --pre-hook "apachectl -k stop" --post-hook "apachectl -k start"`
1. With a browser, go to your hostname to complete Wordpress installation.
   1. Remember to save your password!
1. Install the plugin.
   1. Go to the "Releases" section for the Teddy Hyde Wordpress plugin hosted on GitHub: https://github.com/tedhyde/teddyhyde-wp-plugin. Download the latest release as a ZIP file.
   1. Go to plugins and "Add New" and then "Upload Plugin". Then, "Activate" the "Teddy Hyde Wordpress" plugin.
1. On https://admin.teddyhyde.com login and register your new blog 
   1. Make sure to enter in your Ethereum public address into which you want micro-donations to be received.
       1. Don't have an Ethereum address? Go to coinbase and get one: https://www.coinbase.com/join/5137dfce1bd353af550000b4
   1. Choose the amount and currency you prefer (USD or Ethereum)
1. Back on your WordPress server...
   1. Add a new post.
   1. Watch as access to the post is gated by making a micro-donation or watching a blog owner controlled advertisement.
  

