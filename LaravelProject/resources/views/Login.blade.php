<form action="{{ route('login') }}" class="form" method="POST">
    @csrf
    <div class="flex-column">
        <label>Email</label>
        <div class="inputForm">
            <input type="text" class="input" name="email" placeholder="Enter your Email" required>
        </div>
    </div>

    <div class="flex-column">
        <label>Password</label>
        <div class="inputForm">
            <input type="password" class="input" name="password" placeholder="Enter your Password" required>
        </div>
    </div>

    <div class="flex-row">
        <div>
            <input type="checkbox" name="remember">
            <label>Remember me</label>
        </div>
        <span class="span">Forgot password?</span>
    </div>

    <button class="button-submit">Sign In</button>
    <p class="p">Don't have an account? <span class="span">Sign Up</span></p>
    <p class="p line">Or With</p>

    <!-- Champ caché pour définir le type d'utilisateur -->
    <input type="hidden" name="user_type" value="client"> <!-- ou admin, livreur -->
</form>
