from fabric.api import run, put, env, hosts, cd

env.user = 'root'
env.port = 2222


@hosts('jackmuratore.com')
def deploy():
    run('mkdir -p /app/jack/')
    put('./production-compose.yml', '/app/jack/docker-compose.yml')
    with cd('/app/jack'):
        run('docker-compose pull')
        run('docker-compose up -d')
