# Se já existir arquivo app_bkp_maitenance.php, pula esta etapa
if [ -f web/app_bkp_maintenance.php ]; then
    echo '*** "Modo de manutenção" já estava ativado'
else
    # Se não existir arquivo web/maintenance.php, o comando copy daria erro, então pula
    if [ -f web/maintenance.php ] && [ -f web/app.php ]; then
        echo '*** enabling "Modo de manutenção"' && \
        mv web/app.php web/app_bkp_maintenance.php && \
        cp web/maintenance.php web/app.php
    else
        echo '*** "Modo de manutenção" não pode ser ativado (maintenance.php ou app.php não existe)'
    fi
fi

# A partir de agora, tem que tudo dar certo para sair do modo de manutenção
echo '*** updating git repo' && \
git pull && \
echo '*** writing commit hash to git-current-commit.txt' && \
git rev-parse HEAD > github_hook/git-current-commit.txt && \
echo '*** composer install' && \
php composer.phar -vvv install && \
echo '*** loading node from nvm' && \
source ~/.nvm/nvm.sh && \
echo '*** npm install' && \
npm install && \
node -e 'require("less")' &&\
echo '*** linking components' && \
ln -f -s -n ../components web/components && \
echo '*** linking components_manual' && \
ln -f -s -n ../components_manual web/components_manual && \
echo '*** clearing prod cache' && \
php app/console cache:clear --env=prod && \
echo '*** assetic dump' && \
php app/console assetic:dump --env=prod && \
echo '*** assets install' && \
php app/console assets:install web --symlink --relative && \
echo '*** migrações que devem ser feitas no banco de dados' && \
php app/console doctrine:schema:update --dump-sql && \
echo '*** disabling "Modo de manutenção"' && \
mv web/app_bkp_maintenance.php web/app.php && \
echo '*** success!'


