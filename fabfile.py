import base64
import yaml

from fabric.api import local

def get_tokens():
    account_yml = local('kubectl get serviceaccounts drone -o yaml', capture=True)
    account = yaml.load(account_yml)
    secret_name = account['secrets'][0]['name']
    secret_yml = local('kubectl get secrets %s -o yaml' % secret_name, capture=True)
    secret = yaml.load(secret_yml)
    cert = secret['data']['ca.crt']
    token_64 = secret['data']['token']
    print '***********token64*************'
    print token_64
    token = base64.standard_b64decode(token_64)
    print '***********cert************'
    print cert
    print '***********token***********'
    print token


    






