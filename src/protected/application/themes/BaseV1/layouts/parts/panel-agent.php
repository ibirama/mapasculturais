<article class="objeto clearfix">
    <h1>
        <?php if($entity->isUserProfile): ?>
            <a class="icone icon_profile hltip active js-disable" title="Este é seu agente padrão."></a>
        <?php else: ?>
            <a class="icone icon_profile hltip" title="Definir este agente como meu agente padrão." href="<?php echo $app->createUrl('agent', 'setAsUserProfile', array($entity->id)); ?>"></a>
        <?php endif; ?>
        <a href="<?php echo $entity->singleUrl; ?>"><?php echo $entity->name; ?></a>
    </h1>
    <div class="objeto-meta">
        <div><span class="label">Tipo:</span> <?php echo $entity->type->name?></div>
        <div><span class="label">Área de atuação:</span> <?php echo implode(',', $entity->terms['area'])?></div>
    </div>
    <div>
        <a class="btn btn-small btn-primary" href="<?php echo $entity->editUrl; ?>">editar</a>
        <?php if(!$entity->isUserProfile): ?>

            <?php if($entity->status === \MapasCulturais\Entities\Agent::STATUS_ENABLED): ?>
                <a class="btn btn-small btn-danger" href="<?php echo $entity->deleteUrl; ?>">excluir</a>
            <?php else: ?>
                <a class="btn btn-small btn-success" href="<?php echo $entity->undeleteUrl; ?>">recuperar</a>
                <?php if($entity->canUser('destroy')): ?>
                    <a class="btn btn-small btn-danger" href="<?php echo $entity->destroyUrl; ?>">excluir definitivamente</a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</article>