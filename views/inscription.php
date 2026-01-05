<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - DeliveryPro</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }


        /* Signup Section */
        .signup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px);
            padding: 40px 20px;
        }

        .signup-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
            padding: 50px;
            width: 100%;
            max-width: 550px;
            animation: fadeInUp 0.8s ease-out;
        }

        .signup-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .signup-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            margin: 0 auto 20px;
            animation: pulse 2s ease-in-out infinite;
        }

        .signup-header h2 {
            color: #333;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .signup-header p {
            color: #666;
            font-size: 1em;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95em;
        }

        .required {
            color: #e74c3c;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #667eea;
        }

        .form-control {
            width: 100%;
            padding: 15px 15px 15px 50px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.valid {
            border-color: #4caf50;
        }

        .form-control.invalid {
            border-color: #e74c3c;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            color: #999;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        select.form-control {
            padding-left: 50px;
            cursor: pointer;
        }

        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }

        .strength-weak {
            background: #e74c3c;
            width: 33%;
        }

        .strength-medium {
            background: #f39c12;
            width: 66%;
        }

        .strength-strong {
            background: #4caf50;
            width: 100%;
        }

        .password-hint {
            font-size: 0.85em;
            color: #999;
            margin-top: 5px;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 25px;
        }

        .terms-checkbox input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            margin-top: 2px;
        }

        .terms-checkbox label {
            color: #666;
            font-size: 0.9em;
            line-height: 1.5;
        }

        .terms-checkbox a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .terms-checkbox a:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(118, 75, 162, 0.4);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 15px;
            color: #999;
            font-size: 0.9em;
            position: relative;
            z-index: 1;
        }

        .login-link {
            text-align: center;
            color: #666;
            font-size: 0.95em;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9em;
            display: none;
            border-left: 4px solid #c33;
        }

        .error-message.show {
            display: block;
            animation: shake 0.5s ease;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9em;
            display: none;
            border-left: 4px solid #4caf50;
        }

        .success-message.show {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes rotate {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(5deg); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                flex-direction: column;
                gap: 20px;
            }

            .signup-box {
                padding: 30px 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .auth-buttons {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <?php include "./nav.php"?>

    <!-- Signup Section -->
    <div class="signup-container">
        <div class="signup-box">
            <div class="signup-header">
                <div class="signup-icon">📝</div>
                <h2>Créer un compte</h2>
                <p>Rejoignez DeliveryPro dès maintenant</p>
            </div>

            <div class="error-message" id="errorMessage"></div>
            <div class="success-message" id="successMessage"></div>

            <form id="signupForm" onsubmit="handleSignup(event)">
                <div class="form-row">
                    <div class="form-group">
                        <label for="prenom">Prénom <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <span class="input-icon">👤</span>
                            <input 
                                type="text" 
                                id="prenom" 
                                class="form-control" 
                                placeholder="Jean"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <span class="input-icon">👤</span>
                            <input 
                                type="text" 
                                id="nom" 
                                class="form-control" 
                                placeholder="Dupont"
                                required
                            >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <span class="input-icon">📧</span>
                        <input 
                            type="email" 
                            id="email" 
                            class="form-control" 
                            placeholder="votre.email@exemple.com"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <span class="input-icon">📱</span>
                        <input 
                            type="tel" 
                            id="telephone" 
                            class="form-control" 
                            placeholder="+212 6XX XXX XXX"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="role">Type de compte <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <span class="input-icon">💼</span>
                        <select id="role" class="form-control" required>
                            <option value="">Sélectionnez un type</option>
                            <option value="client">Client</option>
                            <option value="livreur">Livreur</option>
                            <option value="entreprise">Entreprise</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input 
                            type="password" 
                            id="password" 
                            class="form-control" 
                            placeholder="••••••••"
                            required
                            minlength="8"
                        >
                        <button 
                            type="button" 
                            class="password-toggle" 
                            onclick="togglePassword('password')"
                            id="toggleBtn1"
                        >
                            👁️
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="password-hint">Au moins 8 caractères, avec majuscules et chiffres</div>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirmer le mot de passe <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input 
                            type="password" 
                            id="confirmPassword" 
                            class="form-control" 
                            placeholder="••••••••"
                            required
                        >
                        <button 
                            type="button" 
                            class="password-toggle" 
                            onclick="togglePassword('confirmPassword')"
                            id="toggleBtn2"
                        >
                            👁️
                        </button>
                    </div>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">
                        J'accepte les <a href="terms.html" target="_blank">Conditions d'utilisation</a> 
                        et la <a href="privacy.html" target="_blank">Politique de confidentialité</a>
                    </label>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    Créer mon compte
                </button>
            </form>

            <div class="divider">
                <span>OU</span>
            </div>

            <div class="login-link">
                Vous avez déjà un compte ? 
                <a href="connexion.php">Connectez-vous</a>
            </div>
        </div>
    </div>

    <script>
        function handleSignup(event) {
            event.preventDefault();
            
            const prenom = document.getElementById('prenom').value;
            const nom = document.getElementById('nom').value;
            const email = document.getElementById('email').value;
            const telephone = document.getElementById('telephone').value;
            const role = document.getElementById('role').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const terms = document.getElementById('terms').checked;

            // Validation
            if (password !== confirmPassword) {
                showError('Les mots de passe ne correspondent pas');
                return;
            }

            if (!terms) {
                showError('Veuillez accepter les conditions d\'utilisation');
                return;
            }

            // Animation du bouton
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.textContent = 'Création en cours...';
            submitBtn.disabled = true;

            // Simulation d'inscription
            setTimeout(() => {
                console.log('Données d\'inscription:', {
                    prenom, nom, email, telephone, role, password
                });

                showSuccess('Compte créé avec succès ! Redirection...');
                
                setTimeout(() => {
                    window.location.href = 'connexion.php';
                }, 2000);
            }, 1500);
        }

        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleBtn = fieldId === 'password' ? 
                document.getElementById('toggleBtn1') : 
                document.getElementById('toggleBtn2');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = '👁️';
            }
        }

        function showError(message) {
            const errorMsg = document.getElementById('errorMessage');
            errorMsg.textContent = message;
            errorMsg.classList.add('show');
            
            setTimeout(() => {
                errorMsg.classList.remove('show');
            }, 4000);
        }

        function showSuccess(message) {
            const successMsg = document.getElementById('successMessage');
            successMsg.textContent = message;
            successMsg.classList.add('show');
        }

        // Validation en temps réel de l'email
        document.getElementById('email').addEventListener('input', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailRegex.test(this.value)) {
                this.classList.add('valid');
                this.classList.remove('invalid');
            } else if (this.value.length > 0) {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else {
                this.classList.remove('valid', 'invalid');
            }
        });

        // Validation du téléphone
        document.getElementById('telephone').addEventListener('input', function() {
            const phoneRegex = /^[+]?[\d\s-]{10,}$/;
            if (phoneRegex.test(this.value)) {
                this.classList.add('valid');
                this.classList.remove('invalid');
            } else if (this.value.length > 0) {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else {
                this.classList.remove('valid', 'invalid');
            }
        });

        // Indicateur de force du mot de passe
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');
            let strength = 0;

            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            strengthBar.className = 'password-strength-bar';
            
            if (strength <= 1) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }

            if (password.length >= 8) {
                this.classList.add('valid');
                this.classList.remove('invalid');
            } else if (password.length > 0) {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else {
                this.classList.remove('valid', 'invalid');
                strengthBar.style.width = '0';
            }
        });

        // Vérification de la confirmation du mot de passe
        document.getElementById('confirmPassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            if (this.value === password && this.value.length > 0) {
                this.classList.add('valid');
                this.classList.remove('invalid');
            } else if (this.value.length > 0) {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else {
                this.classList.remove('valid', 'invalid');
            }
        });

        // Animation des inputs
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>