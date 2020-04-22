kubecm
######

* github [1]_
  


下载
====

Homebrew::

    $ brew install sunny0826/tap/kubecm


binary::

    $ VERSION=0.8.0
    # linux x86_64
    $ curl -Lo kubecm.tar.gz https://github.com/sunny0826/kubecm/releases/download/v${VERSION}/kubecm_${VERSION}_Linux_x86_64.tar.gz
    # macos
    $ curl -Lo kubecm.tar.gz https://github.com/sunny0826/kubecm/releases/download/v${VERSION}/kubecm_${VERSION}_Darwin_x86_64.tar.gz
    # windows
    $ curl -Lo kubecm.tar.gz https://github.com/sunny0826/kubecm/releases/download/v${VERSION}/kubecm_${VERSION}_Windows_x86_64.tar.gz

Auto-Completion
===============

bash::

    # bash
    kubecm completion bash > ~/.kube/kubecm.bash.inc
    printf "
    # kubecm shell completion
    source '$HOME/.kube/kubecm.bash.inc'
    " >> $HOME/.bash_profile
    source $HOME/.bash_profile

zsh::

    # add to $HOME/.zshrc 
    source <(kubecm completion zsh)
    # or
    kubecm completion zsh > "${fpath[1]}/_kubecm"

使用
====

kubecm -h::

    Usage:
      kubecm [flags]
      kubecm [command]

    Available Commands:
      add         Merge configuration file with $HOME/.kube/config
      completion  Generates bash/zsh completion scripts
      delete      Delete the specified context from the kubeconfig
      help        Help about any command
      merge       Merge the kubeconfig files in the specified directory
      namespace   Switch or change namespace interactively
      rename      Rename the contexts of kubeconfig
      switch      Switch Kube Context interactively
      version     Print version info

    Flags:
          --config string   path of kubeconfig (default "$HOME/.kube/config")
      -h, --help   help for kubecm

add子命令::

    # Merge example.yaml with $HOME/.kube/config.yaml
    kubecm add -f example.yaml 

    # Merge example.yaml and name contexts test with $HOME/.kube/config.yaml
    kubecm add -f example.yaml -n test

    # Overwrite the original kubeconfig file
    kubecm add -f example.yaml -c

merge子命令::

    # Merge kubeconfig in the directory
    kubecm merge -f dir

    # Merge kubeconfig in the directory and overwrite the original kubeconfig file
    kubecm merge -f dir -c








.. [1] https://github.com/sunny0826/kubecm