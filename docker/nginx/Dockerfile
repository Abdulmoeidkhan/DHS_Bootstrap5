# Use built app container to copy compiled frontend assets and static files
FROM dhs-app:latest AS app_source

FROM nginx:alpine

# Copy custom Nginx configuration
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy public static files and Vite build assets from app container
COPY --from=app_source /var/www/public /var/www/public

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
