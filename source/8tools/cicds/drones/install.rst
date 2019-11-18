安装
#########

Runner
=========

::

    $ docker run -d \
      -e DRONE_RPC_PROTO=https \
      -e DRONE_RPC_HOST=drone.company.com \
      -e DRONE_RPC_SECRET=super-duper-secret \
      -p 3000:3000 \
      --restart always \
      --name runner \
      drone/drone-runner-ssh

agent
=========

::

    docker run -d \
      -v /var/run/docker.sock:/var/run/docker.sock \
      -e DRONE_RPC_PROTO=http \
      -e DRONE_RPC_HOST=drone.zhaoweiguo.com:7080 \
      -e DRONE_RPC_SECRET=bea26a2221fd8090ea3872xxxx45eca6 \
      -e DRONE_RUNNER_CAPACITY=2 \
      -e DRONE_RUNNER_NAME=${HOSTNAME} \
      -p 3333:3000 \
      --restart always \
      --name runner \
      drone/agent:1

Server
========

gitlab
------

说明::

    docker run \
      --volume=/var/run/docker.sock:/var/run/docker.sock \
      --volume=/var/lib/drone:/data \
      --env=DRONE_GIT_ALWAYS_AUTH=false \
      --env=DRONE_GITLAB_SERVER={your-gitlab-url} \  # gitlab 的 URL
      --env=DRONE_GITLAB_CLIENT_ID={your-gitlab-applications-id} \  # GitLab的Application中的id
      --env=DRONE_GITLAB_CLIENT_SECRET={your-gitlab-secret} \ # GitLab的Application中的secret
      --env=DRONE_SERVER_HOST={your-drone-url} \    # drone 的URl
      --env=DRONE_SERVER_PROTO=http \
      --env=DRONE_TLS_AUTOCERT=false \
      --env=DRONE_USER_CREATE=username:{your-admin-username},admin:true \   # Drone的管理员
      --publish=8000:80 \
      --publish=443:443 \
      --restart=always \
      --detach=true \
      --name=drone \
      drone/drone:1.1

实例::

    docker run \
      --volume=/var/lib/drone:/data \
      --env=DRONE_AGENTS_ENABLED=true \
      --env=DRONE_GITLAB_SERVER=http://gitlab.zhaoweiguo.com \
      --env=DRONE_GITLAB_CLIENT_ID=d6cffd9d9d91a6d2a0ad7xxxxx1b3c12d246ca3c39e1 \
      --env=DRONE_GITLAB_CLIENT_SECRET=94da807ea2eae55599aexxxxx840ba1ddd37314fb611bf \
      --env=DRONE_RPC_SECRET=bea26a2221fxxxxx38720fc445eca6 \
      --env=DRONE_SERVER_HOST=drone.zhaoweiguo.com:7080 \
      --env=DRONE_SERVER_PROTO=http \
      --publish=7080:80 \
      --publish=7443:443 \
      --restart=always \
      --detach=true \
      --name=drone2 \
      drone/drone:1


github
------

说明::

    docker run \
      --volume=/var/lib/drone:/data \
      --env=DRONE_AGENTS_ENABLED=true \
      --env=DRONE_GITHUB_SERVER=https://github.com \
      --env=DRONE_GITHUB_CLIENT_ID=${DRONE_GITHUB_CLIENT_ID} \
      --env=DRONE_GITHUB_CLIENT_SECRET=${DRONE_GITHUB_CLIENT_SECRET} \
      --env=DRONE_RPC_SECRET=${DRONE_RPC_SECRET} \
      --env=DRONE_SERVER_HOST=${DRONE_SERVER_HOST} \    # drone 的URl
      --env=DRONE_SERVER_PROTO=${DRONE_SERVER_PROTO} \
      --env=DRONE_TLS_AUTOCERT=false \
      --env=DRONE_USER_CREATE=username:{your-admin-username},admin:true \   # Drone的管理员
      --publish=80:80 \
      --publish=443:443 \
      --restart=always \
      --detach=true \
      --name=drone \
      drone/drone:1

实例::

    docker run \
      --volume=/var/lib/drone:/data \
      --env=DRONE_AGENTS_ENABLED=true \
      --env=DRONE_GITHUB_SERVER=https://github.com \
      --env=DRONE_GITHUB_CLIENT_ID=672a81b131ce0923e440 \
      --env=DRONE_GITHUB_CLIENT_SECRET=75210eebc6eb5b7f6434763507c46d51b600b8a4 \
      --env=DRONE_RPC_SECRET=bea26a2221fd8090ea38720fc445eca6 \
      --env=DRONE_SERVER_HOST=drone.zhaoweiguo.com:7080 \
      --env=DRONE_SERVER_PROTO=http \
      --env=DRONE_TLS_AUTOCERT=false \
      --env=DRONE_USER_CREATE=username:zhaoweiguo,admin:true \
      --publish=7080:80 \
      --publish=7443:443 \
      --restart=always \
      --detach=true \
      --name=drone \
      drone/drone:1
















