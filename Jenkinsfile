pipeline {
    agent any

    environment {
        IMAGE_NAME = 'devops-lab-web'
    }

    options {
        skipDefaultCheckout(true)
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build image') {
            steps {
                sh 'docker build -t ${IMAGE_NAME}:${BUILD_NUMBER} .'
            }
        }

        stage('Security scan') {
            steps {
                sh '''
                    docker run --rm \
                      -v /var/run/docker.sock:/var/run/docker.sock \
                      -v trivy_cache:/root/.cache/ \
                      aquasec/trivy:latest image \
                      --scanners vuln \
                      --severity HIGH,CRITICAL \
                      --ignore-unfixed \
                      --no-progress \
                      --exit-code 0 \
                      ${IMAGE_NAME}:${BUILD_NUMBER}

                    docker run --rm \
                      -v /var/run/docker.sock:/var/run/docker.sock \
                      -v trivy_cache:/root/.cache/ \
                      aquasec/trivy:latest image \
                      --scanners vuln \
                      --severity CRITICAL \
                      --ignore-unfixed \
                      --no-progress \
                      --exit-code 1 \
                      ${IMAGE_NAME}:${BUILD_NUMBER}
                '''
            }
        }

        stage('Verify') {
            steps {
                sh 'docker images | grep ${IMAGE_NAME}'
            }
        }
    }
}
