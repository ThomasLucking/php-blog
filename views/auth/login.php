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
        <form action="/login" method="POST">
            <h5 class="text-xl font-bold text-white mb-6">Sign in to our platform</h5>
            <?php if (isset($errors['login'])): ?>
                <p class="text-2xs text-red-400">
                    <span class="font-medium">Error</span> <?= htmlspecialchars($errors['login']) ?>
                </p>
            <?php endif; ?>
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-white">Your username</label>
                <input type="text" id="name" name="name"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="example@company.com" required />
            </div>
            <?php if (isset($errors['email'])): ?>
                <p class="text-2xs text-red-400">
                    <span class="font-medium">Error</span> <?= htmlspecialchars($errors['email']) ?>
                </p>
            <?php endif; ?>
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-white">Your email</label>
                <input type="email" id="email" name="email"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="example@company.com" required />
            </div>
            <?php if (isset($errors['password'])): ?>
                <p class="text-2xs text-red-400">
                    <span class="font-medium">Error</span> <?= htmlspecialchars($errors['password']) ?>
                </p>
            <?php endif; ?>
            <div class="mb-4">
                <label for="password" class="block mb-2 text-sm font-medium text-white">Your password</label>
                <input type="password" id="password" name="password"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="" required />
            </div>

            <div class="flex items-start my-6">
                <div class="flex items-center">
                    <input id="checkbox-remember" type="checkbox"
                        class="w-4 h-4 border border-[#1e293b] rounded bg-slate-800 focus:ring-2 focus:ring-[#60a5fa]">
                    <label for="checkbox-remember" class="ms-2 text-sm font-medium text-white">Remember me</label>
                </div>
            </div>

            <button type="submit"
                class="text-white bg-[#60a5fa] hover:bg-blue-500 font-bold rounded text-sm px-4 py-2.5 w-full mb-3 transition">
                Login to your account
            </button>

            <div class="text-sm font-medium text-slate-400">
                Not registered? <a href="/register" class="text-[#60a5fa] hover:underline">Create account</a>
            </div>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>