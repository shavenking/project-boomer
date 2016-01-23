# 安裝 Git

Git 是版本控制的工具。

## 測試是否有安裝過 Git

打開終端機輸入 `git version` ，如果有顯示版本代表有安裝。

範例：`git version 2.4.1`

## 安裝 Git

安裝 [GitHub Desktop](https://desktop.github.com) 同時勾選安裝 Git 。

請參考[這篇教學](https://github.com/blog/1510-installing-git-from-github-for-mac)。

# 安裝 Homestead

請在終端機輸入指令： `vagrant box add laravel/homestead` 。

安裝畫面如下：

```
➜  project-boomer git:(master) vagrant box add laravel/homestead
==> box: Loading metadata for box 'laravel/homestead'
    box: URL: https://atlas.hashicorp.com/laravel/homestead
This box can work with multiple providers! The providers that it
can work with are listed below. Please review the list and choose
the provider you will be working with.

1) virtualbox
2) vmware_desktop

Enter your choice: 1
==> box: Adding box 'laravel/homestead' (v0.4.0) for provider: virtualbox
    box: Downloading: https://atlas.hashicorp.com/laravel/boxes/homestead/versions/0.4.0/providers/virtualbox.box
    box: Progress: 7% (Rate: 723k/s, Estimated time remaining: 0:22:28)
```

安裝完後，在終端機輸入下列指令：

1. `cd ~`
2. `git clone https://github.com/laravel/homestead.git Homestead`
3. `cd Homestead`
4. `bash init.sh`
5. `vagrant up`

# 安裝本程式

在終端機輸入下列指令：

1. `mkdir ~/Code`
2. `cd ~/Code`
3. `git clone https://github.com/andytsai-shaven/project-boomer.git Laravel`
4. `alias homestead='function __homestead() { (cd ~/Homestead && vagrant $*); unset -f __homestead; }; __homestead'`
5. `homestead ssh`
6. `cd ~/Code/Laravel`
7. `composer install`
8. `cp .env.example .env`
9. `php artisan key:generate`
10. `php artisan migrate --seed`

安裝完畢後，修改 `/etc/hosts` 檔案，加入下列網址：

`192.168.10.10  homestead.app`

在瀏覽器輸入網址 `homestead.app` 即可使用。

以上安裝完畢。