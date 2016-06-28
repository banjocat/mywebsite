from fabric.api import local, execute


def build():
    '''
    Builds latest docker image
    '''
    local('docker build --force-rm --tag jackmuratore:latest .')


def push():
    local('docker push banjocat/jackmuratore:latest')

def run():
    '''
    Runs the single jackmuratore image
    '''
    local('docker run -p 0.0.0.0:8000:8000 --name jackmuratore -d jackmuratore')


def attach():
    '''
    Runs the signle image without daemon
    '''
    local('docker run -p 0.0.0.0:8000:8000 --name jackmuratore jackmuratore')


def remove():
    '''
    Removes running image
    '''
    local('docker stop jackmuratore')
    local('docker rm jackmuratore')

def restart():
    '''
    Restarst the image
    '''
    local('docker restart jackmuratore')


def deploy():
    local((
        "ansible-playbook -i "
        "./ansible/digital_ocean_hosts "
        "--user=root "
        "./ansible/playbook.yml"))
