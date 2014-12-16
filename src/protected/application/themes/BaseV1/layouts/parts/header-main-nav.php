<?php if($app->getConfig('auth.provider') === 'Fake' && $app->user->id !== 1): ob_start(); ?>
    <style>
        span.fake-dummy{
            white-space:nowrap; padding: 0.5rem 0 0 0.5rem; cursor:default;
        }
        span.fake-dummy a{
            display:inline !important; font-weight:bold !important; vertical-align: baseline !important;
        }
    </style>
    <span class="fake-dummy">
        Admin:
        <a onclick="jQuery.get('<?php echo $app->createUrl('auth', 'fakeLogin') ?>/?fake_authentication_user_id=1',
            function(){
                console.info('Logado como Admin');
                MapasCulturais.Messages.success('Logado como Admin.');
            })">
            Login
        </a>
        <a onclick="jQuery.get('<?php echo $app->createUrl('auth', 'fakeLogin') ?>/?fake_authentication_user_id=1',
            function(){ location.reload();})">
            Reload
        </a>
    </span>
<?php $fake_options = ob_get_clean(); endif; ?>

<nav id="main-nav" class="alignright clearfix">
    <ul class="menu abas-objetos clearfix">
        <li id="aba-eventos" ng-class="{'active':data.global.filterEntity === 'event'}" ng-click="tabClick('event')">
            <a href="<?php if ($this->controller->action !== 'search') echo $app->createUrl('busca') . '##(global:(enabled:(event:!t),filterEntity:event))'; ?>">
                <div class="icone icon_calendar"></div>
                <div>Eventos</div>
            </a>
        </li>
        <li id="aba-espacos" ng-class="{'active':data.global.filterEntity === 'space'}" ng-click="tabClick('space')">
            <a href="<?php if ($this->controller->action !== 'search') echo $app->createUrl('busca') . '##(global:(enabled:(space:!t),filterEntity:space))'; ?>">
                <div class="icone icon_building"></div>
                <div>Espaços</div>
            </a>
        </li>
        <li id="aba-agentes" ng-class="{'active':data.global.filterEntity === 'agent'}" ng-click="tabClick('agent')">
            <a href="<?php if ($this->controller->action !== 'search') echo $app->createUrl('busca') . '##(global:(enabled:(agent:!t),filterEntity:agent))'; ?>">
                <div class="icone icon_profile"></div>
                <div>Agentes</div>
            </a>
        </li>
        <li id="aba-projetos"  ng-class="{'active':data.global.filterEntity === 'project'}" ng-click="tabClick('project')">
            <a href="<?php if ($this->controller->action !== 'search') echo $app->createUrl('busca') . '##(global:(enabled:(project:!t),filterEntity:project,viewMode:list))'; ?>">
                <div class="icone icon_document_alt"></div>
                <div>Projetos</div>
            </a>
        </li>
    </ul>
    <!--.menu.abas-objetos-->
    <ul class="menu logado clearfix">
        <?php if ($app->auth->isUserAuthenticated()): ?>

            <li class="notificacoes" ng-controller="NotificationController" ng-hide="data.length == 0">

                <a>
                    <div class="icone icon_comment"></div>
                    <div>Notificações</div>
                </a>
                <ul class="submenu">
                    <li>
                        <div class="setinha"></div>
                        <div class="clearfix">
                            <h6 class="alignleft">Notificações</h6>
                            <a href="#" style="display:none" class="staging-hidden hltip icone icon_check_alt" title="Marcar todas como lidas"></a>
                        </div>
                        <ul>
                            <li ng-repeat="notification in data" on-last-repeat="adjustScroll();">
                                <p class="notificacao clearfix">
                                    <span ng-bind-html="notification.message"></span>
                                    <br>

                                    <a ng-if="notification.request.permissionTo.approve" class="btn btn-small btn-success" ng-click="approve(notification.id)">aceitar</a>

                                    <span ng-if="notification.request.permissionTo.reject">
                                        <span ng-if="notification.request.requesterUser.id === MapasCulturais.userId">
                                            <a class="btn btn-small btn-default" ng-click="reject(notification.id)">cancelar</a>
                                            <a class="btn btn-small btn-success" ng-click="delete(notification.id)">ok</a>
                                        </span>
                                        <span ng-if="notification.request.requesterUser.id !== MapasCulturais.userId">
                                            <a class="btn btn-small btn-danger" ng-click="reject(notification.id)">rejeitar</a>
                                        </span>
                                    </span>

                                    <span ng-if="!notification.isRequest">
                                        <a class="btn btn-small btn-success" ng-click="delete(notification.id)">ok</a>
                                    </span>

                                </p>
                            </li>
                        </ul>
                        <a href="<?php echo $app->createUrl('panel'); ?>">
                            Ver todas atividades
                        </a>
                    </li>
                </ul>
                <!--.submenu-->
            </li>
            <!--.notificacoes-->

            <li class="usuario">
                <a href="<?php echo $app->createUrl('panel'); ?>">
                    <div class="avatar">
                        <?php if ($app->user->profile->avatar): ?>
                            <img src="<?php echo $app->user->profile->avatar->transform('avatarSmall')->url; ?>" />
                        <?php else: ?>
                            <img src="<?php $this->asset('img/avatar.png'); ?>" />
                        <?php endif; ?>
                    </div>
                </a>
                <ul class="submenu">
                    <div class="setinha"></div>
                    <li>
                        <a href="<?php echo $app->createUrl('panel'); ?>">Painel</a>
                    </li>
                    <li>
                        <a href="<?php echo $app->createUrl('panel', 'events') ?>">Meus Eventos</a>
                        <a class="add" href="<?php echo $app->createUrl('event', 'create') ?>" ></a>
                    </li>
                    <li>
                        <a href="<?php echo $app->createUrl('panel', 'agents') ?>">Meus Agentes</a>
                        <a class="add" href="<?php echo $app->createUrl('agent', 'create') ?>"></a>
                    </li>
                    <li>
                        <a href="<?php echo $app->createUrl('panel', 'spaces') ?>">Meus Espaços</a>
                        <a class="add"href="<?php echo $app->createUrl('space', 'create') ?>"></a>
                    </li>
                    <li>
                        <a href="<?php echo $app->createUrl('panel', 'projects') ?>">Meus Projetos</a>
                        <a class="add" href="<?php echo $app->createUrl('project', 'create') ?>"></a>
                    </li>
                    <li class="row"></li>
                    <!--<li><a href="#">Ajuda</a></li>-->
                    <li>
                        <?php if($app->getConfig('auth.provider') === 'Fake'): ?>
                            <a href="<?php echo $app->createUrl('auth'); ?>">Trocar Usuário</a>
                            <?php if(!empty($fake_options)) echo $fake_options; ?>
                        <?php endif; ?>
                        <a href="<?php echo $app->createUrl('auth', 'logout'); ?>">Sair</a>
                    </li>
                </ul>
            </li>
            <!--.usuario-->
        <?php else: ?>
            <li class="entrar">
                <a href="<?php echo $app->createUrl('panel') ?>">
                    <div class="icone icon_lock"></div>
                    <div>Entrar</div>
                </a>
                <?php if(!empty($fake_options)): ?>
                    <ul class="submenu" style="margin: 2px 0 0 -12px"><li><?php echo str_ireplace("Login\n        </a>", 'Login</a> |', $fake_options) ?></li></ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>
    </ul>
    <!--.menu.logado-->
</nav>