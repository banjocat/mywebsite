Vagrant.configure("2") do |config|

    config.vm.provision "ansible" do |ansible|
        ansible.playbook = "./ansible/playbook.yml"
    end

    config.vm.define "web" do |web|
        web.vm.box = "ubuntu/trusty64"
    end

end
