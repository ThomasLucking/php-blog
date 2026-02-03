<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<?php
use Thomas\PhpBlog\Config\Flash;

$errors = Flash::getValueAndDelete('errors') ?? [];


if (isset($errors['password'])) {
    $inputColors = 'border-red-400 bg-red-900/20 text-red-400 placeholder:text-red-300';
} else {
    $inputColors = 'border-[#1e293b] bg-slate-800 text-white placeholder:text-slate-500';
}
?>

<main class="grow flex items-center justify-center">
    <div class="w-full max-w-sm p-6 border-2 rounded-md border-slate-800 bg-slate-900 shadow-xl">

        <form action="/StoreInfo" method="POST">
            <h5 class="text-xl font-bold text-white mb-6">Modify account details</h5>
            <?php if (isset($errors['email'])): ?>
                <p class="text-2xs text-red-400">
                    <span class="font-medium">Error</span> <?= htmlspecialchars($errors['email']) ?>
                </p>
            <?php endif; ?>
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-white">Your username</label>
                <input type="name" id="email" name="Edit_name"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="newUsernameExample" value="<?= htmlspecialchars($_SESSION["name"]) ?>" />
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-white">Your email</label>
                <input type="email" id="email" name="Edit_email"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="example@company.com" value="<?= htmlspecialchars($_SESSION['email']) ?>" />
            </div>
            <?php if (isset($errors['password'])): ?>
                <p class="text-2xs text-red-400">
                    <span class="font-medium">Error</span> <?= htmlspecialchars($errors['password']) ?>
                </p>
            <?php endif; ?>
            <div class="mb-4">
                <label for="Original password" class="block mb-2 text-sm font-medium text-white">Original
                    Password</label>
                <input type="password" id="password" name="Original_password"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="" required />
            </div>
            <div class="mb-4">
                <label for="New password" class="block mb-2 text-sm font-medium text-white">New password (optional)</label>
                <input type="password" id="password" name="New_password"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="" />
            </div>
            <button type="submit"
                class="text-white bg-[#60a5fa] hover:bg-blue-500 font-bold rounded text-sm px-4 py-2.5 w-full mb-3 transition">
                Save account details.
            </button>

        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>