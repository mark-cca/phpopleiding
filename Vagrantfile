# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "generic/ubuntu2004"
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.synced_folder ".", "/home/vagrant/php-opleiding"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  # config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  config.vm.provider "virtualbox" do |vb|
    # Display the VirtualBox GUI when booting the machine
    vb.gui = true
    # Set name of box
    vb.name = "php_opleiding"

    # Customize the amount of memory on the VM:
    vb.memory = "4096"

    vb.cpus = 4
  end

  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", inline: <<-SHELL
      apt-get update
      apt-get install -y lsb-release ca-certificates apt-transport-https software-properties-common
      add-apt-repository ppa:ondrej/php
      apt-get update
      apt-get install -y apache2 mysql-server php8.1 php8.1-mysql
      cp /home/vagrant/php-opleiding/provision/phpopleiding.conf /etc/apache2/sites-available/phpopleiding.conf
      a2ensite phpopleiding.conf
      a2dissite 000-default.conf
      sudo a2enmod rewrite
      systemctl reload apache2

      echo "create database opleiding" | mysql
      echo "CREATE USER 'opleiding'@'localhost' IDENTIFIED BY 'opleiding'" | mysql
      echo "GRANT ALL PRIVILEGES ON opleiding.* TO 'opleiding'@'localhost';" | mysql
      echo "ALTER USER 'opleiding'@'localhost' IDENTIFIED WITH mysql_native_password BY 'opleiding';" | mysql
      echo "flush privileges" | mysql
    SHELL
end
