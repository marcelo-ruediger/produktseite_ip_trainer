# Vercel Deployment Guide

## Database Security Notice

**IMPORTANT**: Your database credentials are kept secure and will NOT be pushed to GitHub or Vercel's code repository.

## How it works:

### Local Development:

-   Your actual database credentials are in `config.php` (ignored by git)
-   The app uses your local database when running locally

### Vercel Deployment:

-   The app runs in "demo mode" without database functionality
-   No database credentials are exposed
-   The rating form still works but shows a demo message

## To deploy:

1. **Commit your changes** (database credentials will NOT be included):

    ```bash
    git add .
    git commit -m "Add Vercel configuration"
    git push origin main
    ```

2. **Deploy to Vercel**:

    - Go to [vercel.com](https://vercel.com)
    - Import your GitHub repository
    - Vercel will automatically detect the `vercel.json` configuration
    - Your site will be deployed without database functionality

3. **Optional: Add database to Vercel** (advanced):
    - If you want database functionality on Vercel, you'd need to:
        - Set up a cloud database (like PlanetScale, Railway, or Vercel Postgres)
        - Add environment variables in Vercel dashboard
        - Never put credentials in your code

## Security Features:

-   ✅ Database credentials stay in `config.php` (git ignored)
-   ✅ No credentials in your GitHub repository
-   ✅ No credentials in Vercel's code storage
-   ✅ App works as a demo when no database is available
-   ✅ Production-ready configuration
