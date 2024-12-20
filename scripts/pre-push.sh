#!/bin/bash

# Get the current branch name
current_branch=$(git symbolic-ref HEAD | sed -e 's,.*/\(.*\),\1,')

# Check for restricted branches
#if [ "$current_branch" = "production" ] || [ "$current_branch" = "stage" ] || [ "$current_branch" = "homolog" ]; then
#    echo "ERRO: Você está na branch $current_branch. Commits diretos nessa branch não são permitidos!"
#    exit 1
#fi

if [ "$current_branch" = "production" ] || [ "$current_branch" = "stage" ] || [ "$current_branch" = "homolog" ]; then
  echo "ERRO: Você está na branch $current_branch. Commits diretos nessa branch não são permitidos!"
  git push --no-verify origin refs/heads/$current_branch:$current_branch
  exit 1
fi
