# Docker 

Documentation and information related to the Docker setup of this project. 

## .docker/Dockerfile

To build the image use the following command: `docker build -f .docker/Dockerfile .`

This Dockerfile serves as the production image and should be as small as possible. 
To improve the performance of the container, the `xdebug` extension is disabled. 

Composer is set up in a way that dependencies are not downloaded everytime a file is changed. The dependencies should only be downloaded if either the `composer.json` or `composer.lock` files were modified.  
Because this is already the production image, composer is instructed to optimize the autoloader and to omit development dependencies. After installing the applications dependencies the composer cache is cleared. 

## .dockerignore

The .dockerignore file controls which files are included in the Docker build context. 
By excluding files and/or directories from the build context, we can make sure that the resulting image is small and that our secrets from the .env files are not included in the image. 
