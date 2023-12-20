<?php
    /** @var $impreza ?\App\Model\impreza */
?>

<div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" id="subject" name="impreza[subject]" value="<?= $impreza ? $impreza->getSubject() : '' ?>">
</div>

<div class="form-group">
    <label for="content">Content</label>
    <textarea id="content" name="impreza[content]"><?= $impreza? $impreza->getContent() : '' ?></textarea>
</div>

<div class="form-group">
    <label for="date">Date</label>
    <input type="date" id="date" name="impreza[date]" value="<?= $impreza ? $impreza->getDate() : '' ?>">
</div>

<div class="form-group">
    <label></label>
    <input type="submit" value="Submit">
</div>
