#!/bin/bash

# Função que faz um loop infinito para consumir CPU
cpu_load() {
  while :; do :; done
}

# Verifica se o estresse já está em execução
if pgrep -f "cpu_load" > /dev/null; then
    echo "Estresse de CPU já está em execução."
    exit 1
fi

echo "Iniciando estresse de CPU..."

# Detecta o número de núcleos da CPU
CPU_CORES=$(nproc)

# Inicia um processo para cada núcleo disponível
for ((i = 1; i <= CPU_CORES; i++)); do
  cpu_load &  # Executa em segundo plano
done

# Armazena o PID dos processos em um arquivo
echo $! > /tmp/cpu_stress.pid
