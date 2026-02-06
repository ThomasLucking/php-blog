<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<?php
use Thomas\PhpBlog\Config\Flash;

$errors = Flash::getValueAndDelete('errors') ?? [];


$getInputClass = function($fieldName) use ($errors) {
    $base = "text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 outline-none transition ";
    
    if (isset($errors[$fieldName])) {
        return $base . "border-red-400 bg-red-900/10 text-red-400 placeholder:text-red-300";
    }
    
    return $base . "bg-slate-800 border-slate-700 text-white placeholder:text-slate-500";
};
?>

<main class="grow flex items-center justify-center py-10">
    <div class="w-full max-w-sm p-6 border-2 rounded-md border-slate-800 bg-slate-900 shadow-xl">
        <form action="/account/update" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <h5 class="text-xl font-bold text-white mb-6">Modify account details</h5>

            <div class="mb-4">
                <label for="Edit_name" class="block mb-2 text-sm font-medium text-white">Your username</label>
                <input type="text" id="Edit_name" name="Edit_name"
                    class="<?= $getInputClass('Edit_name') ?>"
                    placeholder="newUsernameExample" 
                    value="<?= htmlspecialchars($_SESSION["name"] ?? '') ?>" />
                <?php if (isset($errors['Edit_name'])): ?>
                    <p class="mt-1 text-xs text-red-400"><?= htmlspecialchars($errors['Edit_name']) ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="Edit_email" class="block mb-2 text-sm font-medium text-white">Your email</label>
                <input type="email" id="Edit_email" name="Edit_email"
                    class="<?= $getInputClass('Edit_email') ?>"
                    placeholder="example@company.com" 
                    value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" />
                <?php if (isset($errors['Edit_email'])): ?>
                    <p class="mt-1 text-xs text-red-400"><?= htmlspecialchars($errors['Edit_email']) ?></p>
                <?php endif; ?>
            </div>

            <hr class="border-slate-800 my-6">

            <div class="mb-4">
                <label for="Original_password" class="block mb-2 text-sm font-medium text-white">Current Password</label>
                <input type="password" id="Original_password" name="Original_password"
                    class="<?= $getInputClass('Original_password') ?>"
                    placeholder="••••••••" required />
                <?php if (isset($errors['Original_password'])): ?>
                    <p class="mt-1 text-xs text-red-400"><?= htmlspecialchars($errors['Original_password']) ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-6">
                <label for="New_password" class="block mb-2 text-sm font-medium text-white">New password (optional)</label>
                <input type="password" id="New_password" name="New_password"
                    class="<?= $getInputClass('New_password') ?>"
                    placeholder="Leave blank to keep current" />
                <?php if (isset($errors['New_password'])): ?>
                    <p class="mt-1 text-xs text-red-400"><?= htmlspecialchars($errors['New_password']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit"
                class="text-white bg-[#60a5fa] hover:bg-blue-500 font-bold rounded text-sm px-4 py-2.5 w-full transition shadow-lg shadow-blue-500/20">
                Save account details
            </button>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>