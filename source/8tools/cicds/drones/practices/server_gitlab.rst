gitlab实例
##########

创建共享密钥::

    共享密钥用于在Drone Server与各Drone Runner间通信认证时使用
    $ openssl rand -hex 16
    bea26a2221fd8090ea38720fc445eca6

服务启动命令如下::

    docker run \
      --volume=/var/lib/drone:/data \
      --env=DRONE_GIT_ALWAYS_AUTH=false \
      --env=DRONE_GITLAB_SERVER=http://gitlab.com \
      --env=DRONE_GITLAB_CLIENT_ID=${DRONE_GITLAB_CLIENT_ID} \
      --env=DRONE_GITLAB_CLIENT_SECRET=${DRONE_GITLAB_CLIENT_SECRET} \
      --env=DRONE_RPC_SECRET=${DRONE_RPC_SECRET} \
      --env=DRONE_SERVER_HOST=${DRONE_SERVER_HOST} \
      --env=DRONE_SERVER_PROTO=${DRONE_SERVER_PROTO} \
      --env=DRONE_TLS_AUTOCERT=false \
      --env=DRONE_USER_CREATE=username:zhaoweiguo,admin:true \
      --publish=80:80 \
      --publish=443:443 \
      --restart=always \
      --detach=true \
      --name=drone \
      drone/drone:1


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








