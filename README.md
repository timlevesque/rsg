# RSG

## Introduction

This is the repo for Hoag.org. We use VVV for our local development process and have a live/dev/local workflow.

- http://local.rsg.com/ 

## Prerequiesets

1. You need to install vagrant, virtualbox, and git. 
2. Install VVV https://bitbucket.org/snippets/stucker_hoag/BBzyEj 


## getting your local repo set up

1. Update your VVV /config/config.yml file and edit it `sudo nano /config/vvv-config.yml`
2. paste 

```
sites: 
  hoag:
	  repo: https://{user_name}:{password}@bitbucket.org/hoagdev/hoag.git
    branch: dev
    hosts:
      - local.rsg.com
```
3. replace {user_name} and {password} with your bitbucket account information.
4. watch for proper spacing
5. close nano and save changes.
6. Run `vagrant -up provision` ...get up and stretch your legs, this while take a few minutes.

If successful, you should have a fully functional local site ready for editing. 

Make sure you `git checkout {{your dev branch}}` before you start editing your local repo.

## Dev Testing environment

We do most of our work in the dev repo. On any push to the repo, a deployment script runs and deploys code changes (not database changes) to dev.webrsg.com

If you don't see your changes, you can also force the deployment to dev.hoag.io with
https://dev.hoag.io/deploy/deploy.php?sat=AppleSauces&repo=dev 

### testing specific branches

If experimenting or working on a major modification, you can create a custom branch. If you want to demonstrate that branch in our test environment you need to notify the team (so we don't push in changes) and you can force the deployment into dev.hoag.io by modifying the repo variable.
https://dev.hoag.io/deploy/deploy.php?sat=AppleSauces&repo={repo name}