<style>
      /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            animation: slideDown 0.5s ease-out;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            animation: rotate 3s ease-in-out infinite;
        }

        .project-name {
            font-size: 1.8em;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-connexion {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-connexion:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-inscription {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: 2px solid transparent;
        }

        .btn-inscription:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(118, 75, 162, 0.5);
        }
</style>
 <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="logo-section">
                <div class="logo">🚚</div>
                <div class="project-name">DeliveryPro</div>
            </div>
            <div class="auth-buttons">
                <a href="../views/connexion.php"><button class="btn btn-connexion">Connexion<button></a>
                <a href="../views/inscription.php"><button class="btn btn-inscription">Inscription</button></a>
                
            </div>
        </nav>
    </header>
