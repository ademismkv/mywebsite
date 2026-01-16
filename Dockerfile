FROM wordpress:latest

# Copy your entire public directory into the official WordPress container
# This ensures your theme, plugins, and custom config are all there.
COPY app/public/ /var/www/html/

# Ensure permissions are correct for the web server
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80 (Railway standard)
EXPOSE 80
