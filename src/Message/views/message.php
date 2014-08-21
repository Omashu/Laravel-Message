<style>.unstyled{margin:0;padding:0;list-style-type: none;}</style>

<?php if ($result->grouped() and $result->sorted()): ?>
	<?php foreach ($result->messages() as $type => $values): ?>
		<div class="alert alert-<?=$type?>">
			<ul class="unstyled">
				<?php foreach ($values as $messages): ?>
					<?php foreach ($messages as $message): ?>
						<li><?php echo $message->getMessage() ?></li>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endforeach; ?>

	<?php return; ?>
<?php endif; ?>

<?php if ($result->grouped() and !$result->sorted()): ?>
	<?php foreach ($result->messages() as $type => $messages): ?>
		<div class="alert alert-<?=$type?>">
			<ul class="unstyled">
				<?php foreach ($messages as $message): ?>
					<li><?php echo $message->getMessage() ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endforeach; ?>

	<?php return; ?>
<?php endif; ?>

<?php if ($result->sorted()): ?>
	<?php foreach ($result->messages() as $values): ?>
		<?php foreach ($values as $message): ?>
			<div class="alert alert-<?=$message->getType()?>">
				<?php echo $message->getMessage() ?>
			</div>
		<?php endforeach; ?>
	<?php endforeach; ?>

	<?php return; ?>
<?php endif; ?>

<?php foreach ($result->messages() as $message): ?>
	<div class="alert alert-<?=$message->getType()?>">
		<?php echo $message->getMessage() ?>
	</div>
<?php endforeach; ?>