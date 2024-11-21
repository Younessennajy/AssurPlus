
<div class="container">
    <h2>Modifier l'enregistrement</h2>

    <form action="<?php echo e(route('admin.data.update', ['pays' => $pays->name, 'type' => $type, 'id' => $data->id])); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <?php if($type === 'b2b'): ?>
            <div class="form-group">
                <label for="raison_social">Raison Sociale</label>
                <input type="text" class="form-control" id="raison_social" name="raison_social" value="<?php echo e($data->raison_social); ?>">
            </div>
            
            <div class="form-group">
                <label for="dirigeant_prenom">Prénom du Dirigeant</label>
                <input type="text" class="form-control" id="dirigeant_prenom" name="dirigeant_prenom" value="<?php echo e($data->dirigeant_prenom); ?>">
            </div>

            <div class="form-group">
                <label for="dirigeant_name">Nom du Dirigeant</label>
                <input type="text" class="form-control" id="dirigeant_name" name="dirigeant_name" value="<?php echo e($data->dirigeant_name); ?>">
            </div>
        <?php else: ?>
            <div class="form-group">
                <label for="first_name">Prénom</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo e($data->first_name); ?>">
            </div>

            <div class="form-group">
                <label for="last_name">Nom</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo e($data->last_name); ?>">
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" value="<?php echo e($data->ville); ?>">
        </div>

        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e($data->phone); ?>">
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/admin/data/edit.blade.php ENDPATH**/ ?>