# MediaHub — Documentation API REST

**Base URL :** `http://127.0.0.1:8000/api`

**Authentification :** Laravel Sanctum (token Bearer)

---

## 🔐 Authentification

### 1. Connexion

**`POST /api/connexion`** (public)

**Body (JSON) :**
```json
{
    "email": "admin@mediahub.tn",
    "password": "password"
}