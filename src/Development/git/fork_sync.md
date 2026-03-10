## fork项目与原库同步
- 把自己fork的项目clone到本地，查看远程仓库地址

        git remote -v
        origin	https://github.com/lcp0578/SensioGeneratorBundle.git (fetch)
        origin	https://github.com/lcp0578/SensioGeneratorBundle.git (push)
- 添加原库远程仓库地址到本地项目

        git remote add sensio https://github.com/sensiolabs/SensioGeneratorBundle.git //其中sensio是别名
        git remote -v
        origin	https://github.com/lcp0578/SensioGeneratorBundle.git (fetch)
        origin	https://github.com/lcp0578/SensioGeneratorBundle.git (push)
        sensio	https://github.com/sensiolabs/SensioGeneratorBundle.git (fetch)
        sensio	https://github.com/sensiolabs/SensioGeneratorBundle.git (push)
- 把原仓库最新代码拉到本地

		git fetch  sensio
        remote: Counting objects: 19, done.
        remote: Total 19 (delta 11), reused 11 (delta 11), pack-reused 8
        Unpacking objects: 100% (19/19), done.
        From https://github.com/sensiolabs/SensioGeneratorBundle
         * [new branch]      2.0        -> sensio/2.0
         * [new branch]      2.1        -> sensio/2.1
         * [new branch]      2.2        -> sensio/2.2
         * [new branch]      2.4        -> sensio/2.4
         * [new branch]      2.5        -> sensio/2.5
         * [new branch]      master     -> sensio/master
         * [new tag]         v3.1.7     -> v3.1.7

- checkout fork项目的 master分支

		git checkout master
        Already on 'master'
        Your branch is up-to-date with 'origin/master'.
- 把原仓库的master分支合并到本地的master分支

		git merge sensio/master
        Updating 8ed1344..28cbaa2
        Fast-forward
         Command/GenerateCommandCommand.php        | 4 +---
         Command/GenerateControllerCommand.php     | 4 +---
         Command/GenerateDoctrineCrudCommand.php   | 4 +---
         README.md                                 | 2 ++
         Resources/skeleton/form/FormType.php.twig | 2 +-
         5 files changed, 6 insertions(+), 10 deletions(-)
- 把本地代码推送至fork项目的远程地址
        git push -u origin master -f
        Counting objects: 18, done.
        Delta compression using up to 4 threads.
        Compressing objects: 100% (17/17), done.
        Writing objects: 100% (18/18), 2.91 KiB | 0 bytes/s, done.
        Total 18 (delta 12), reused 0 (delta 0)
        remote: Resolving deltas: 100% (12/12), completed with 8 local objects.
        To https://github.com/lcp0578/SensioGeneratorBundle.git
           8ed1344..28cbaa2  master -> master
        Branch master set up to track remote branch master from origin.
- 推送成功后，已fork仓库与原仓库代码保持一致，可以提交自己的修改，然后提PR了。