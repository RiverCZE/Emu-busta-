@echo off
title Emu Busta
:loop
java -jar -Xmx1000m -Xms1000m elbustemu.jar
goto loop
PAUSE