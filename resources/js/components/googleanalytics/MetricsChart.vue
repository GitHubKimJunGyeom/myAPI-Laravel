<script setup lang="ts">
import { Bar } from 'vue-chartjs';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  LineElement,
  CategoryScale,
  LinearScale,
  PointElement,
} from 'chart.js';

// Chart.js에 사용할 컴포넌트 등록
ChartJS.register(Title, Tooltip, Legend, BarElement,LineElement, CategoryScale, LinearScale, PointElement);

const props = defineProps<{
  chartData: object
  targetDate: string
}>();

const chartData = {
  labels: Object.keys(props.chartData),
  datasets: [
    {
      label: "value",
      data: Object.values(props.chartData),
      backgroundColor: '#4f46e5',
    },
  ]
};

const chartOptions = { 
  responsive: true,
  plugins: {
    legend: {
      position: 'top' as const,
      labels: {
        color: '#374151',
        font: {
          size: 14,
          weight: 'bold',
        },
      },
    },
    title: {
      display: true,
      text: props.targetDate,
      font: {
        size: 24,         // 폰트 크기
        weight: 'bold',   // 폰트 두께 (예: 'normal', 'bold', 'bolder' 등)
        family: 'Arial',  // 폰트 가족 (선택 사항)
        lineHeight: 1.2,  // 줄 간격
      },
      color: '#000000',   // 텍스트 색상
    },
    tooltip: {
      callbacks: {
        label: (context: any) => `Value: ${context.formattedValue}`,
      },
    },
  },
  scales: {
    y: {
      beginAtZero: true,
      title: {
        display: true,
        text: 'Value',
      },
      ticks: {
        stepSize: 1,
      },
    },
    x: {
      title: {
        display: true,
        text: 'Metrics',
      },
    },
  },
} as const;

</script>

<template>
  <Bar
    :data="chartData" 
    :options="chartOptions" 
  />
</template>
  

  